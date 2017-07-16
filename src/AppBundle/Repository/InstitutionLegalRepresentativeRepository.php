<?php

namespace AppBundle\Repository;

/**
 * InstitutionLegalRepresentativeRepository
 */
class InstitutionLegalRepresentativeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
