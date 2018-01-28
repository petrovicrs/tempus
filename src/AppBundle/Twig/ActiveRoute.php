<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 16.08.17
 * Time: 23:13
 */

namespace AppBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ActiveRoute extends \Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'activeRoute' => new \Twig_SimpleFunction('activeRoute', array($this, 'istActiveRoute')),
            'subNavRoute' => new \Twig_SimpleFunction('subNavRoute', array($this, 'isSubNavigationRoute')),
        );
    }


    public function istActiveRoute($route)
    {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        return strpos($request->get('_route'), $route) !== false;
    }

    public function getName()
    {
        return 'activeRoute';
    }

    public function isSubNavigationRoute()
    {
        $subNav = ['action', 'intelectual_output', 'resource', 'result', 'report'];
        $route = $this->container->get('request_stack')->getCurrentRequest()->get('_route');

        foreach ($subNav as $one) {
            if(strpos($route, $one) !== false) {
                return true;
            }

        }

        return false;
    }
}