<?php
namespace AppBundle\Twig;


use Symfony\Component\DependencyInjection\ContainerInterface;

class LocalizedPath extends \Twig_Extension
{

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'localizedPath' => new \Twig_SimpleFunction('localizedPath', array($this, 'getLocalizedPath')),
        );
    }


    public function getLocalizedPath($route, $parameters = [], $referenceType = [])
    {
        if(!isset($parameters['locale'])){
            $parameters['locale'] = $this->container->get('translator')->getLocale();
        }

        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }

    public function getName()
    {
        return 'localizedPath';
    }

}