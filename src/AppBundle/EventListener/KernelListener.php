<?php
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

class KernelListener
{
    protected $container;

    public function __construct(ContainerInterface $container) // this is @service_container
    {
        $this->container = $container;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $requestUriParts = explode("/",$request->getRequestUri());
        if(isset($requestUriParts[1]) && $requestUriParts[1] != ""){
            $request->setLocale($requestUriParts[1]);
            $this->container->get('translator')->setLocale($requestUriParts[1]);
        }
    }
}