<?php

namespace AppBundle\Repository;

/**
 * InstitutionAccreditationRepository
 */
class InstitutionAccreditationRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
