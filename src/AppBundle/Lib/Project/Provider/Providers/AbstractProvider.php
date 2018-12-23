<?php

namespace AppBundle\Lib\Project\Provider\Providers;

use AppBundle\Entity\User;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class AbstractProvider
 *
 * @package AppBundle\Lib\Project\Provider\Providers
 */
abstract class AbstractProvider implements ProviderInterface {

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
     * @param $id
     *
     * @return object
     */
    protected function get($id) {
        return $this->container->get($id);
    }

    /**
     * @return ManagerRegistry
     */
    protected function getDoctrine() {
        /** @var ManagerRegistry $doctrine */
        $doctrine = $this->container->get('doctrine');
        return $doctrine;
    }

}