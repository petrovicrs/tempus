<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

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
        'option_fields_list' => [
            'title' => 'Lookup',
            'children' => []
        ],
        'user_list' => [
            'title' => 'Users',
            'roles' => ['ROLE_SUPER_ADMIN', 'ROLE_APP_SUPER_ADMIN'],
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

    /** @var AuthorizationChecker */
    private $securityContext;

    /**
     * @param FactoryInterface $factory
     * @param ContainerInterface $container
     */
    public function __construct(FactoryInterface $factory, ContainerInterface $container) {
        $this->factory = $factory;
        $this->container = $container;
        $this->securityContext = $this->container->get('security.authorization_checker');
    }

    /**
     * @param RequestStack $requestStack
     *
     * @return \Knp\Menu\ItemInterface
     */
    public function createMainMenu(RequestStack $requestStack) {
        $menu = $this->factory->createItem('root');
        $menu->setChildrenAttribute('id', 'main_menu');
        $menu->setChildrenAttribute('class', 'nav navbar-nav sf-menu');
        foreach ($this->getMainMenuItems() as $menuItem) {
            if ($menuItem->isAccessible()) {
                $this->addMenuItem($menuItem, $menu, $requestStack);
            }
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
            $title = isset($item['title']) ? $item['title'] : '_______________MISSING_TITLE_______________';
            $children = isset($item['children']) ? $item['children'] : [];
            $roles = isset($item['roles']) ? $item['roles'] : [];
            $menuItem = $this->createMenuItem($route, $title, $children, $roles);
            $menuItems[] = $menuItem;
        }
        return $menuItems;
    }

    private function createMenuItem($route, $title, array $children = [], array $roles = []) {
        $menuItem = new MenuItem($this->securityContext);
        $menuItem->setRoute($route);
        $menuItem->setTitle($title);
        $menuItem->setAccessibleRoles($roles);
        foreach ($children as $child_route => $child) {
            $title = isset($child['title']) ? $child['title'] : '_______________MISSING_TITLE_______________';
            $children = isset($child['children']) ? $child['children'] : [];
            $roles = isset($child['roles']) ? $child['roles'] : [];
            $childItem = $this->createMenuItem($child_route , $title, $children, $roles);
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