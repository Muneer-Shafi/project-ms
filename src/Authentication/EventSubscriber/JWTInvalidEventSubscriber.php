<?php

declare(strict_types=1);

/*
 * This file is part of Muneer's learning project.
 *
 * (c) Muneer shafi <mcamuneershafi@gmail.com>.
 */

namespace App\Authentication\EventSubscriber;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class JWTInvalidEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::JWT_INVALID => 'JWTAuthenticationInvalid',
        ];
    }

    public function JWTAuthenticationInvalid(JWTInvalidEvent $event): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $response = $event->getResponse();
        $payload['ip'] = $request->getClientIp();
    }
}
