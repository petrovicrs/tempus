<?php

namespace AppBundle\Repository;

/**
 * InstitutionTypeRepository
 */
class InstitutionTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
