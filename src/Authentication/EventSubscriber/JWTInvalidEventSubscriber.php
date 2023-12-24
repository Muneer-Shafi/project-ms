<?php

declare(strict_types=1);

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
