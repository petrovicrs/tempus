<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class MenuBuilder
 *
 * @package AppBundle\Menu
 */
class MenuBuilder {

    /** @var array */
    private static $main_menu_items = [
        'search_projects' => [
            'title' => 'Search',
            'children' => []
        ],
        'person_list' => [
            'title' => 'Persons',
            'children' => []
        ],
        'institution_list' => [
            'title' => 'Institutions',
            'children' => []
        ],
        'project_list' => [
            'title' => 'Projects',
            'children' => []
        ],
        'project_programs_list' => [
            'title' => 'Project programs',
            'children' => []
        ],
        'user_list' => [
            'title' => 'Users',
            'children' => [
                'user_group_list' => [
                    'title' => 'User groups',
                    'children' => [
                        'user_group_create' => [
                            'title' => 'User group add',
                            'children' => []
                        ]
                    ]
                ]
            ]
        ],
    ];

    /** @var FactoryInterface */
    private $factory;

    /** @var ContainerInterface */
    private $container;

    /**
     * @param FactoryInterface $factory
     * @param ContainerInterface $container
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container) {
        $this->factory = $factory;
        $this->container = $container;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack) {
        $securityContext = $this->container->get('security.authorization_checker');
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('id', 'main_menu');
        $menu->setChildrenAttribute('class', 'nav navbar-nav sf-menu');
        foreach ($this->getMainMenuItems() as $menuItem) {
            $this->addMenuItem($menuItem, $menu, $requestStack);
        }
        return $menu;
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createUserMenu(RequestStack $requestStack) {
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

    /**
     * @return MenuItem[]
     */
    private function getMainMenuItems() {
        $menuItems = [];
        foreach (self::$main_menu_items as $route => $item) {
            $menuItem = $this->createMenuItem($route, $item['title'], $item['children']);
            $menuItems[] = $menuItem;
        }
        return $menuItems;
    }

    private function createMenuItem($route, $title, array $children = []) {
        $menuItem = new MenuItem();
        $menuItem->setRoute($route);
        $menuItem->setTitle($title);
        foreach ($children as $child_route => $child) {
            $childItem = $this->createMenuItem($child_route , $child['title'], $child['children']);
            $menuItem->addChild($childItem);
        }
        return $menuItem;
    }

    /**
     * @param MenuItem $menuItem
     * @param ItemInterface $menu
     * @param RequestStack $requestStack
     */
    private function addMenuItem(MenuItem $menuItem, ItemInterface $menu, RequestStack $requestStack) {
        $menu->addChild($menuItem->getTitle(), [
            'route' => $menuItem->getRoute(),
            'routeParameters' => [
                'locale' => $requestStack->getCurrentRequest()->getLocale(),
            ]
        ]);
        foreach ($menuItem->getChildren() as $children) {
            $this->addMenuItem($children, $menu[$menuItem->getTitle()], $requestStack);
        }
    }

}