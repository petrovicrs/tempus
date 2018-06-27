<?php

namespace AppBundle\Repository;

/**
 * InstitutionRepository
 */
class InstitutionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }

    public function delete($institution)
    {
        $this->_em->remove($institution);
        $this->_em->flush();
    }
}

