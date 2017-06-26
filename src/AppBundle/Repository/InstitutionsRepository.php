<?php

namespace AppBundle\Repository;

/**
 * InstitutionRepository
 */
class InstitutionsRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
