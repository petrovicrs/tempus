<?php

namespace AppBundle\Repository;

/**
 * Class PersonNoteRepository
 */
class PersonNoteRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNote) {

        $this->_em->persist($personNote);
        $this->_em->flush();
    }

}
