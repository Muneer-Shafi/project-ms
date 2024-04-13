<?php

declare(strict_types=1);

use App\Authentication\Entity\User;
use App\Authentication\Security\AccessTokenFailureHandler;
use App\Authentication\Security\AccessTokenHandler;
use Symfony\Config\SecurityConfig;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

return static function (SecurityConfig $security) {
    $security->passwordHasher(PasswordAuthenticatedUserInterface::class)
        ->algorithm('auto');

    $apiFirewall = $security->firewall('api');

    $apiFirewall
        ->pattern('^/external_api')
        ->accessToken()
        ->tokenHandler(AccessTokenHandler::class)
        ->failureHandler(AccessTokenFailureHandler::class);


    $apiFirewall->provider('app_users');
    $security
        ->provider('app_users')
        ->entity()
        ->class(User::class)
        ->property('username');

    $security->accessDecisionManager()
        ->strategy('unanimous')
        ->allowIfAllAbstain(false);

    $mainFirewall = $security
        ->firewall('main')
        ->lazy(true)
        ->provider('app_users')
        //        ->entryPoint(AuthenticationEntryPoint::class)
        //        ->customAuthenticators([\App\Authentication\Security\UserAuthenticator::class])
        ->lazy(true);
    $mainFirewall->entryPoint('form_login');
    //    $mainFirewall->pattern('/api')->stateless(true)->jwt([]);

    $mainFirewall->jsonLogin()
        ->checkPath('api_login')
        ->usernamePath('email')
        ->successHandler('lexik_jwt_authentication.handler.authentication_success')
        ->failureHandler('lexik_jwt_authentication.handler.authentication_failure')
        ->passwordPath('password');

    $mainFirewall->formLogin()
        ->loginPath('security_login')
        ->checkPath('security_login')
        ->enableCsrf(true)
        ->defaultTargetPath('blog_index');

    $mainFirewall->rememberMe()
        ->secret('%kernel.secret%')
        ->lifetime(604800);

    $mainFirewall->logout()
        ->path('security_logout')
        ->target('homepage')
        ->invalidateSession(true);

    $security->accessControl()
        ->path('^/(%app_locales%)/admin')
        ->roles('ROLE_ADMIN');

    $security->roleHierarchy('ROLE_ADMIN', ['ROLE_USER', 'ROLE_STUDENT']);
    $security->roleHierarchy('ROLE_SUPER_ADMIN', ['ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH']);

    $devFireWall = $security->firewall('development')
        ->pattern('^/(_(profiler|wdt)|css|images|js)/')
        ->security(false);

    $security
        ->passwordHasher(PasswordAuthenticatedUserInterface::class)->algorithm('auto')
        ->cost(4)
        ->timeCost(3)
        ->memoryCost(10);
    $security->roleHierarchy('ROLE_ADMIN', ['ROLE_USER']);
    $security->roleHierarchy('ROLE_SUPER_ADMIN', ['ROLE_ADMIN', 'ROLE_ALLOWED_TO_SWITCH']);
};
