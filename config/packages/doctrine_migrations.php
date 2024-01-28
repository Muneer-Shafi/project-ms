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
};