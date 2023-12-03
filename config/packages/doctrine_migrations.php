<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Config\DoctrineMigrationsConfig;

return static function (ContainerConfigurator $containerConfigurator, DoctrineMigrationsConfig $doctrineMigrationsConfig): void {
    $doctrineMigrationsConfig
        ->migrationsPath('DoctrineMigrations', '%kernel.project_dir%/migrations')
        ->enableProfiler('dev' === $containerConfigurator->env())
        ->storage()
        ->tableStorage()
        ->tableName('migration_versions')
        ->versionColumnName('version')
        ->versionColumnLength(191)
        ->executedAtColumnName('executed_at');

//    <!--doctrine_migrations:-->
//<!--    migrations_paths:-->
//<!--        # namespace is arbitrary but should be different from App\Migrations-->
//<!--        # as migrations classes should NOT be autoloaded-->
//<!--        'DoctrineMigrations': '%kernel.project_dir%/migrations'-->
//<!--    enable_profiler: false-->
};