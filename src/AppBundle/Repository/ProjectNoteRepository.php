<?php

namespace AppBundle\Repository;

/**
 * Class ProjectNoteRepository
 * @package AppBundle\Repository
 */
class ProjectNoteRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
