<?php

namespace AppBundle\Repository;


/**
 * EquipmentRepository
 *
 * This class was generated by the PhpStorm "Php Annotations" Plugin. Add your own custom
 * repository methods below.
 */
class EquipmentRepository extends AbstractRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}
