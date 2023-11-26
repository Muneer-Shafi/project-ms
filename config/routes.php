<?php
# These lines define a route using YAML configuration. The controller used by
# the route (FrameworkBundle:Template:template) is a convenient shortcut when
# the template can be rendered without executing any logic in your own controller.
# See https://symfony.com/doc/current/templates.html#rendering-a-template-directly-from-a-route

use App\Controller\BlogController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Bundle\FrameworkBundle\Controller\TemplateController;

return function (RoutingConfigurator $routes) {

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
    $routes->import('../src/Authentication/', 'annotation')
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
        
    $routes->import('../src/Controller/Admin', 'annotation')
        ->prefix('/{_locale}')
        ->requirements(['_locale' => '%app_locales%'])
        ->defaults([
            '_locale' => '%locale%'
        ]);

};