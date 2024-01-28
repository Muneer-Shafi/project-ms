{
  description = "Symfony app";

  inputs = {
    nixpkgs = {
      url = "github:NixOS/nixpkgs/23.11";
    };
    mysqlJdbcConnectorJar = {
      url = "https://dev.mysql.com/get/Downloads/Connector-J/mysql-connector-java-8.0.29.zip";
      flake = false;
    };
    flake-compat = {
      url = "github:edolstra/flake-compat";
      flake = false;
    };
    devenv.url = "github:cachix/devenv";
    devenv.inputs.nixpkgs.follows = "nixpkgs";
  };

  outputs = { self, nixpkgs, mysqlJdbcConnectorJar, flake-compat, devenv } @inputs:
    let
      # System types to support.
      supportedSystems = [ "x86_64-linux" "x86_64-darwin" "aarch64-linux" "aarch64-darwin" ];
      # Helper function to generate an attrset '{ x86_64-linux = f "x86_64-linux"; ... }'.
      forAllSystems = nixpkgs.lib.genAttrs supportedSystems;
      # Nixpkgs instantiated for supported system types.
      nixpkgsFor = forAllSystems
        (system: import nixpkgs {
          inherit system;
          config = { allowUnfree = true; };
        });
      phpExtensions = [
        "bcmath"
        "curl"
        "dom"
        "fileinfo"
        "ftp"
        "iconv"
        "openssl"
        "pdo"
        "gd"
        "intl"
        "mbstring"
        "posix"
        "session"
        "simplexml"
        "sodium"
        "opcache"
        "zlib"
        "pdo_mysql"
        "sqlite3"
        "zip"
        "apcu"
        "redis"
        "xdebug"
        "soap"
      ];
      phpBuilder = phpVersion: forAllSystems (system:
        phpVersion.withExtensions (
          { all, enabled }: enabled ++ nixpkgs.lib.attrsets.attrValues (nixpkgs.lib.attrsets.getAttrs phpExtensions all)
        ));
      phpConfig = ''
        variables_order = "EGPCS"
        [php]
        upload_max_filesize = 20M
        memory_limit = 2048M
        max_execution_time = 120
        max_input_vars = 5000
        upload_tmp_dir = /tmp
        realpath_cache_size = 12288K
        realpath_cache_ttl = 1800
        [session]
        session.cookie_secure = On
        session.cookie_httponly = On
        session.use_strict_mode = On
        session.cookie_samesite = Strict
        session.cookie_lifetime = 2000000
        session.gc_divisor = 100
        session.gc_maxlifetime = 200000
        session.gc_probability = 1
        [xdebug]
        xdebug.mode = debug
        xdebug.output_dir = /tmp
        xdebug.start_with_request = trigger
        xdebug.client_port = 9003
        xdebug.client_host = localhost
        xdebug.profiler_output_name = xdebug_profiler.out.%t
        [date]
        date.timezone = Europe/Amsterdam
      '';

      # configure php ini settings
      phpConfigured = php: forAllSystems (system: php.${system}.buildEnv {
        extraConfig = phpConfig;
      });

      mysqlJdbcConnector = forAllSystems (system:
        let
          pkgs = nixpkgsFor.${system};
        in
        pkgs.stdenv.mkDerivation {
          name = "mysql-jdbc-connector";
          builder = builtins.toFile "builder"
            ''
              source $stdenv/setup

              set -e

              mkdir -p $out/share/java
              cp $src/mysql-connector-java-*.jar $out/share/java/mysql-connector-java.jar
            ''
          ;
          src = mysqlJdbcConnectorJar;
          buildInputs = [ pkgs.unzip pkgs.ant ];
          meta = {
            platforms = pkgs.lib.platforms.unix;
          };
        });
    in
    {
      # packages.x86_64-linux.qbil-trade = {};
      # defaultPackage.x86_64-linux = self.packages.x86_64-linux.qbil-trade;

      # Shell is run by `nix develop`
      devShells = forAllSystems (system:
        let
          pkgs = nixpkgsFor.${system};
          commonDeps = [
            pkgs.symfony-cli
            pkgs.mysql80 # only installed for the mysql-client, server is run via docker
            pkgs.redis # only installed for redis-cli, server is run via docker
            pkgs.mycli
            pkgs.elmPackages.elm
            pkgs.elmPackages.elm-format
            pkgs.elmPackages.elm-test
            pkgs.nodejs_18
            pkgs.yarn
            pkgs.caddy
            pkgs.lsof
            pkgs.gnugrep
            pkgs.findutils
            pkgs.chromium
            pkgs.docker-compose
            pkgs.glibcLocales
            pkgs.schemaspy # for documenting and exploring database schema
            mysqlJdbcConnector.${system}
            pkgs.pulumi-bin # for deploying
            pkgs.awscli2 # for aws cli access
            pkgs.awsebcli
            pkgs.libsForQt5.kcachegrind # for visualizing xdebug profiler output
            pkgs.graphviz # used by kcachegrind to visualize function call graph
            # PDF packages required for preview monitor
            pkgs.imagemagick
            pkgs.poppler_utils
            pkgs.ghostscript
          ];
        in
        rec {
          default = pkgs.mkShell {
            buildInputs = commonDeps ++ [
              (phpConfigured (phpBuilder pkgs.php83)).${system}
              (phpConfigured (phpBuilder pkgs.php83)).${system}.packages.composer
            ];
            shellHook = ''
              MYSQL_JDBC_DRIVER_PATH=${mysqlJdbcConnector.${system}}
              export PLAYWRIGHT_BROWSERS_PATH="${pkgs.playwright-driver.browsers}"
              export PLAYWRIGHT_SKIP_VALIDATE_HOST_REQUIREMENTS=1
              source ./scripts/local/dev_shell.sh
            '';
          };
          beta = devenv.lib.mkShell {
            inherit inputs pkgs;
            modules = [
              ({ pkgs, config, ... }: {
                languages.php = {
                  enable = true;
                  version = "8.3";
                  ini = phpConfig;
                  extensions = phpExtensions;
                  fpm.pools.web = {
                    settings = {
                      "clear_env" = "no";
                      "pm" = "dynamic";
                      "pm.max_children" = 10;
                      "pm.start_servers" = 2;
                      "pm.min_spare_servers" = 1;
                      "pm.max_spare_servers" = 10;
                    };
                  };
                };
                languages.javascript.package = pkgs.nodejs_20;
                packages = [ ];
                enterShell = ''
                  echo 'Welcome to qbil-trade'
                  echo 'Run `devenv up` to start'
                '';
                services.caddy.enable = true;
                services.mysql.enable = true;
                services.mysql.package = pkgs.mysql80;
                services.mysql.importTimeZones = true;
                services.redis.enable = true;
                # TODO: Need to import both schema and data file for it to work
                # services.mysql.initialDatabases = [
                #   { name = "demo"; schema = ./sql/schema/tenant.sql; }
                #   { name = "central"; schema = ./sql/schema/central.sql; }
                # ];
                services.mysql.settings.mysqld = {
                  "sql_require_primary_key" = "off";
                  "default-authentication-plugin" = "mysql_native_password";
                  "sql_mode" = "NO_ENGINE_SUBSTITUTION";
                  "innodb_strict_mode" = "0";
                  "log_bin_trust_function_creators" = "1";
                  "collation-server" = "utf8mb4_0900_ai_ci";
                  "character-set-server" = "utf8mb4";
                  "default-time-zone" = "+02:00";
                };
                services.caddy.virtualHosts.":8000" = {
                  extraConfig = ''
                    root * public
                    php_fastcgi unix/${config.languages.php.fpm.pools.web.socket}
                    file_server
                  '';
                };
              })
            ];
          };
        });


      packages = forAllSystems (system: {
        devenv-up = self.devShells.${system}.beta.config.procfileScript;
      });
      # Executed by `nix flake check`
      # checks."<system>"."<name>" = derivation;
      # # Executed by `nix build .#<name>`
      # packages."<system>"."<name>" = derivation;
      # # Executed by `nix build .`
      # defaultPackage."<system>" = derivation;
      # # Executed by `nix run .#<name>`
      # apps."<system>"."<name>" = {
      #   type = "app";
      #   program = "<store-path>";
      # };
      # # Executed by `nix run . -- <args?>`
      # defaultApp."<system>" = { type = "app"; program = "..."; };
    };
}
