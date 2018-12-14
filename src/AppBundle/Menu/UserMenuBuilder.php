<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class UserMenuBuilder
 *
 * @package AppBundle\Menu
 */
class UserMenuBuilder {

    /** @var FactoryInterface */
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory) {
        $this->factory = $factory;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function create(RequestStack $requestStack) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        $menu->addChild('menu.users.edit_user', [
            'route' => 'user_edit',
            'routeParameters' => [
                'locale' => $requestStack->getCurrentRequest()->getLocale(),
                'userId' => $requestStack->getCurrentRequest()->get('userId'),
            ]
        ]);
        $menu->addChild('menu.users.edit_user_permissions', [
            'route' => 'user_edit_permissions',
            'routeParameters' => [
                'locale' => $requestStack->getCurrentRequest()->getLocale(),
                'userId' => $requestStack->getCurrentRequest()->get('userId'),
            ]
        ]);
        $menu->addChild('menu.users.edit_user_password', [
            'route' => 'user_edit_password',
            'routeParameters' => [
                'locale' => $requestStack->getCurrentRequest()->getLocale(),
                'userId' => $requestStack->getCurrentRequest()->get('userId'),
            ]
        ]);
        return $menu;
    }

}