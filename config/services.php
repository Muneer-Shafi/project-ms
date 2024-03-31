<?php
declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use App\Authentication\Events\JWTCreatedListener;
use App\EventSubscriber\CommentNotificationSubscriber;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\Security\Http\Logout\LogoutUrlGenerator;

return function (ContainerConfigurator $container) {
    $container->parameters()
        ->set('locale', 'en')
        ->set('app_locales', 'ar|en|fr|de|es|cs|nl|ru|uk|ro|pt_BR|pl|it|ja|id|ca|sl|hr|zh_CN|bg|tr|lt|bs|sr_Cyrl|sr_Latn|eu')
        ->set('app.notifications.email_sender', 'anonymous@example.com');

    $services = $container->services()
        ->defaults()
        ->autowire(true)
        ->autoconfigure()
        ->bind('string $locales', '%app_locales%')
        ->bind('string $emailSender', '%app.notifications.email_sender%')
        ->bind('string $defaultLocale', '%locale%');

    $services->load('App\\', '../src/')
        ->exclude('../src/{DependencyInjection,Entity,Kernel.php}');



    $services->set(CommentNotificationSubscriber::class)->args(

    [
        '$sender'=>'%app.notifications.email_sender%'
    ]);
//    $services->bind(LogoutUrlGenerator::class,'@security.logout_url_generator');
    $services->set(JWTCreatedListener::class)
        ->arg('$requestStack', service(RequestStack::class))
        ->tag('kernel.event_listener', [
            'event' => 'lexik_jwt_authentication.on_jwt_created',
            'method' => 'onJWTCreated',
        ]);

    $services->set(PdoSessionHandler::class)
        ->args([
            env('DATABASE_URL'),
            // you can also use PDO configuration, but requires passing two arguments:
            // 'mysql:dbname=mydatabase; host=myhost; port=myport',
//            ['db_table' => 'session_table', 'db_id_col' => 'guid'],
        ])
    ;

};