<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LocaleSessionListener
 *
 * @package AppBundle\EventListener
 */
class LocaleSessionListener implements EventSubscriberInterface {

    /** @var string */
    private $defaultLocale;

    /**
     * LocaleSessionListener constructor.
     *
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale = 'sr') {
        $this->defaultLocale = $defaultLocale;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event) {
        $request = $event->getRequest();
        if (!$request->hasPreviousSession()) {
            return;
        }
        if ($locale = $request->attributes->get('locale')) {
            $request->getSession()->set('locale', $locale);
        } else {
            $request->setLocale($request->getSession()->get('locale', $this->defaultLocale));
        }
    }

    /**
     * Must be registered before (i.e. with a higher priority than) the default Locale listener
     *
     * @return array
     */
    public static function getSubscribedEvents() {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}