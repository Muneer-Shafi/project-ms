<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;


use Symfony\Config\DoctrineConfig;

return static function (ContainerConfigurator $containerConfigurator, DoctrineConfig $doctrineConfig): void {
    $dbal = $doctrineConfig
        ->dbal()
        ->connection('default')
        ->url(env('DATABASE_URL'));

    $emDefault =
        $doctrineConfig->orm()
            ->autoGenerateProxyClasses(true)
            ->entityManager('default')
            ->autoMapping(true)
            ->namingStrategy('doctrine.orm.naming_strategy.underscore_number_aware')
            ->mapping('AppBundle')
            ->type('xml')
            ->isBundle(false)
            ->type('attribute')
            ->dir('%kernel.project_dir%/src/Entity')
            ->prefix('App\Entity')->alias('App');

};