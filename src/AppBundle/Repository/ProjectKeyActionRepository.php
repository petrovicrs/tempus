<?php

namespace AppBundle\Repository;

/**
 * Class ProjectKeyActionRepository
 * @package AppBundle\Repository
 */
class ProjectKeyActionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
