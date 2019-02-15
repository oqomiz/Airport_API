<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Flight;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Service\Flight as FlightService;

class FlightEventListener implements EventSubscriberInterface
{
    protected $flightService;

    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

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

        $flight->setNumber($this->flightService->generateFlightNumber());
        $flight->setStatus('planned');
    }
}
