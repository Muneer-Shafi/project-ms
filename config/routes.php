<?php

declare(strict_types=1);

use App\Controller\BlogController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;

return static function (RoutingConfigurator $routes) {

    $routes->add('homepage', '/{_locale}')->controller(TemplateController::class)
        ->requirements([
            '_locale' => '%app_locales%'
        ])
        ->defaults([
            'template' => 'default/homepage.html.twig',
            '_locale' => '%locale%'
        ]);

    $routes->import('../src/Controller/', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);
    $routes->import('../src/Authentication/Controller/', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);

    $routes->import('../src/Relation/Controller', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);
    $routes->import('../src/Currency/Controller', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);
    $routes->import('../src/Subsidiary/Controller', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);
    $routes->import('../src/Product/Controller', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);
        
    $routes->import('../src/Controller/Admin', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);

    $routes->withPath('/api/login');

};