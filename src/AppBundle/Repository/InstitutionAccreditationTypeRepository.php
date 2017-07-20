<?php

namespace AppBundle\Repository;

/**
 * InstitutionAccreditationTypeRepository
 */
class InstitutionAccreditationTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
