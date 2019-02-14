<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Flight;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;

class FlightEventListener implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['onKernelView', EventPriorities::POST_VALIDATE],
        ];
    }

    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $flight = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$flight instanceof Flight || (Request::METHOD_POST !== $method)) {
            return;
        }

        // TODO : create service to generate flight number
        $flight->setNumber('test');
    }
}
