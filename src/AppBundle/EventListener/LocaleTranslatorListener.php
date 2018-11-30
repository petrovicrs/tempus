<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LocaleTranslatorListener
 *
 * @package AppBundle\EventListener
 */
class LocaleTranslatorListener {

    /** @var ContainerInterface */
    protected $container;

    /**
     * KernelListener constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event) {
        $request = $event->getRequest();
        $requestUriParts = explode("/",$request->getRequestUri());
        if(isset($requestUriParts[1]) && $requestUriParts[1] != "") {
            // check first if route has locales
            if (strpos($this->container->getParameter('app.locales'), $requestUriParts[1]) !== false) {
                $request->setLocale($requestUriParts[1]);
                $this->container->get('translator')->setLocale($requestUriParts[1]);
            }
        }
    }
}