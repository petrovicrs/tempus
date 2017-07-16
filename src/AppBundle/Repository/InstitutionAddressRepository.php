<?php

namespace AppBundle\Repository;

/**
 * InstitutionAddressRepository
 */
class InstitutionAddressRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
