<?php

namespace AppBundle\Repository;

/**
 * InstitutionContactRepository
 */
class InstitutionContactRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
