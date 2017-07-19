<?php

namespace AppBundle\Repository;

/**
 * InstitutionLevelRepository
 */
class InstitutionLevelRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
