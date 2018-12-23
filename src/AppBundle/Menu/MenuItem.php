<?php

namespace AppBundle\Menu;


use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

/**
 * Class MenuItem
 *
 * @package AppBundle\Menu
 */
class MenuItem {

    /** @var string */
    private $title;

    /** @var string */
    private $route;

    /** @var MenuItem[]  */
    private $children = [];

    /** @var string[] -- if none provided => accessible to all */
    private $accessibleRoles = [];

    /** @var AuthorizationChecker */
    private $securityContext;

    /**
     * MenuItem constructor.
     *
     * @param $securityContext
     */
    public function __construct(AuthorizationChecker $securityContext) {
        $this->securityContext = $securityContext;
    }

    /**
     * @return string
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title) {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getRoute(): string {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute(string $route) {
        $this->route = $route;
    }

    /**
     * @return MenuItem[]
     */
    public function getChildren(): array {
        return $this->children;
    }

    /**
     * @param MenuItem $child
     */
    public function addChild(MenuItem $child) {
        $this->children[] = $child;
    }

    /**
     * @return string[]
     */
    public function getAccessibleRoles(): array {
        return $this->accessibleRoles;
    }

    /**
     * @param string[] $accessibleRoles
     */
    public function setAccessibleRoles(array $accessibleRoles) {
        $this->accessibleRoles = $accessibleRoles;
    }

    /**
     * @param string $accessibleRole
     */
    public function addAccessibleRole($accessibleRole) {
        $this->accessibleRoles[] = $accessibleRole;
    }

    /**
     * Check if menu item is accessible
     *
     * @return bool
     */
    public function isAccessible() {
        $isAccessible = true;
        foreach ($this->accessibleRoles as $accessibleRole) {
            $isAccessible = $this->securityContext->isGranted($accessibleRole);
            if ($isAccessible) {
                break;
            }
        }
        return $isAccessible;
    }

}