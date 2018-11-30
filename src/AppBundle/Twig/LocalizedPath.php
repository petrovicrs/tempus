<?php

namespace AppBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * Class LocalizedPath
 *
 * @package AppBundle\Twig
 */
class LocalizedPath extends \Twig_Extension {

    /** @var ContainerInterface */
    protected $container;

    /**
     * LocalizedPath constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @return array|\Twig_Function[]
     */
    public function getFunctions() {
        return [
            'localizedPath' => new \Twig_SimpleFunction('localizedPath', [$this, 'getLocalizedPath']),
            'localizedMergedPath' => new \Twig_SimpleFunction('localizedPathMerged', [$this, 'getLocalizedPathMerged']),
        ];
    }

    /**
     * @param $route
     * @param array $parameters
     * @param array $referenceType
     *
     * @return mixed
     */
    public function getLocalizedPath($route, $parameters = [], $referenceType = []) {
        if (!isset($parameters['locale'])) {
            $parameters['locale'] = $this->container->get('translator')->getLocale();
        }

        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }

    /**
     * @param $route
     * @param array $currentParams
     * @param array $mergeParams
     * @param array $referenceType
     *
     * @return mixed
     */
    public function getLocalizedPathMerged($route, $currentParams = [], $mergeParams = [], $referenceType = []) {
        foreach ($currentParams as $name => $value) {
            if (array_key_exists($name, $mergeParams)) {
                $currentParams[$name] = $mergeParams[$name];
            }
        }
        return $this->getLocalizedPath($route, $currentParams, $referenceType);
    }

    /**
     * @return string
     */
    public function getName() {
        return 'localizedPath';
    }

}