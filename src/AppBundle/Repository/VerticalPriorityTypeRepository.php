<?php

namespace AppBundle\Repository;

/**
 * VerticalPriorityTypeRepository
 */
class VerticalPriorityTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }
}
