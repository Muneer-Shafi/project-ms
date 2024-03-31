<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Config\DoctrineConfig;

return static function (ContainerConfigurator $containerConfigurator, DoctrineConfig $doctrineConfig): void {
    $dbal = $doctrineConfig
        ->dbal()
        ->defaultConnection('default')
    ;
    $defaultConnectionConfig = $dbal
        ->connection('default')
        ->url('%env(resolve:DATABASE_URL)%');

    $ormConfig = $doctrineConfig
        ->orm()
        ->autoGenerateProxyClasses('dev' === $containerConfigurator->env())
        ->defaultEntityManager('default')
    ;


    $defaultEntityManagerConfig = $ormConfig
        ->entityManager('default')
        ->connection('default')
        ->namingStrategy('doctrine.orm.naming_strategy.underscore_number_aware')
        ->autoMapping('true')
    ;

//    $defaultEntityManagerConfig
//        ->mapping('User')
//        ->isBundle(false)
//        ->type('attribute')
//        ->dir('%kernel.project_dir%/src/User/Domain/Entity')
//        ->prefix('App\User\Domain\Entity');
//
    $defaultEntityManagerConfig
        ->mapping('App')
        ->isBundle(false)
        ->type('attribute')
        ->dir('%kernel.project_dir%/src/Entity')
        ->prefix('App\Entity')
        ->alias('App')
    ;
    $defaultEntityManagerConfig
        ->mapping('Relation')
        ->isBundle(false)
        ->type('attribute')
        ->dir('%kernel.project_dir%/src/Relation/Domain/Entity')
        ->prefix('App\Relation\Domain\Entity')
    ;
    $defaultEntityManagerConfig
        ->mapping('Subsidiary')
        ->isBundle(false)
        ->type('attribute')
        ->dir('%kernel.project_dir%/src/Subsidiary/Entity')
        ->prefix('App\Subsidiary\Entity')
    ;
    $defaultEntityManagerConfig
        ->mapping('Product')
        ->isBundle(false)
        ->type('attribute')
        ->dir('%kernel.project_dir%/src/Product/Entity')
        ->prefix('App\Product\Entity')
    ;


    if ($containerConfigurator->env() === 'test') {
        // TODO some we have do here
    }


    if ($containerConfigurator->env() === 'prod') {
        $defaultConnectionConfig->orm()->autoGenerateProxyClasses(false);
        $defaultEntityManagerConfig
            ->queryCacheDriver()
            ->type('pool')
            ->pool('doctrine.system_cache_pool');
        $defaultEntityManagerConfig
            ->resultCacheDriver()
            ->type('pool')
            ->pool('doctrine.result_cache_pool');
    }
};