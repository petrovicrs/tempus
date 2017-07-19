<?php

namespace AppBundle\Repository;

/**
 * Class ProjectCallRepository
 * @package AppBundle\Repository
 */
class ProjectCallRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
