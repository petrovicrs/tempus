<?php

namespace AppBundle\Repository;

/**
 * InstitutionNoteRepository
 */
class InstitutionNoteRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($institution) {

        $this->_em->persist($institution);
        $this->_em->flush();
    }
}
