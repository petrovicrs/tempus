<?php

namespace AppBundle\Repository;

/**
 * HorizontalPriorityTypeRepository
 */
class HorizontalPriorityTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }
}
