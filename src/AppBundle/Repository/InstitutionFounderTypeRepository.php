<?php

namespace AppBundle\Repository;

/**
 * InstitutionFounderTypeRepository
 */
class InstitutionFounderTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
