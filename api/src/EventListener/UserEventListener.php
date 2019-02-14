<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;

class UserEventListener implements EventSubscriberInterface
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['onKernelView', EventPriorities::POST_VALIDATE],
        ];
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$user instanceof User || (Request::METHOD_POST !== $method && Request::METHOD_PUT !== $method)) {
            return;
        }

        if (!empty($user->getPlainPassword())) {
            $encoded = $this->encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);
            $user->setPlainPassword('');
        }
    }
}
