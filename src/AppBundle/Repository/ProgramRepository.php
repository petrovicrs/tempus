<?php

namespace AppBundle\Repository;

/**
 * ProgramRepository
 */
class ProgramRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}
