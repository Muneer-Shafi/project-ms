<?php

namespace App\Authentication\EventSubscriber;

use App\User\Domain\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

use Lexik\Bundle\JWTAuthenticationBundle\Events;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JWTSuccessEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            Events::AUTHENTICATION_SUCCESS => 'JWTAuthenticationSuccess',
        ];
    }

    public function JWTAuthenticationSuccess(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();
        $user = $event->getUser();
        if (! $user instanceof User) {
            return;
        }
        $data['user'] = $user->jsonSerialize();

        $event->setData($data);
    }
}
