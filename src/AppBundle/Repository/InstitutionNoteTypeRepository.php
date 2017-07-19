<?php

namespace AppBundle\Repository;

/**
 * InstitutionNoteTypeRepository
 */
class InstitutionNoteTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
