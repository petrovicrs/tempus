<?php

namespace AppBundle\Menu;


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
    private $childs = [];

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
        return $this->childs;
    }

    /**
     * @param MenuItem $child
     */
    public function addChild(MenuItem $child) {
        $this->childs[] = $child;
    }

}