<?php

namespace AppBundle\Repository;

/**
 * InstitutionLegalRepresentativePositionRepository
 */
class InstitutionLegalRepresentativePositionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
