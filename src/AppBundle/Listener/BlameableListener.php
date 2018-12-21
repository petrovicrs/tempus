<?php

namespace AppBundle\Listener;

/**
 * Class BlameableListener
 *
 * @package AppBundle\Listener
 */
class BlameableListener extends \Gedmo\Blameable\BlameableListener {


    protected $securityStorage;

    public function getFieldValue($meta, $field, $eventAdapter) {

        if ($this->securityStorage) return $this->securityStorage->getToken()->getUser();

    }

    public function setSecurityStorage($securityStorage) {
        $this->securityStorage = $securityStorage;
    }

}