<?php
declare(strict_types=1);

// config/packages/framework.php
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Config\FrameworkConfig;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

return static function (FrameworkConfig $framework) {

    $framework
        ->secret(env('APP_SECRET'))
        ->handleAllThrowables(true)
        ->httpMethodOverride(false)

          ->csrfProtection()
          ->enabled(true)
      ;



    $framework->esi([]);
    $framework->fragments([]);
    $framework->phpErrors()->log(true);
    $framework->ide(null);
    // ...
    $framework->session()
        ->handlerId(PdoSessionHandler::class);
};