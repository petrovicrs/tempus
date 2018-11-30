<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * Class LoginListener
 *
 * @package AppBundle\EventListener
 */
class LoginListener {

    /** @var EntityManagerInterface */
    private $em;

    /**
     * LoginListener constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    /**
     * @param InteractiveLoginEvent $event
     *
     * @throws \Exception
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event) {
        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLoginCount($user->getLoginCount() + 1);
        $this->em->persist($user);
        $this->em->flush();
    }
}