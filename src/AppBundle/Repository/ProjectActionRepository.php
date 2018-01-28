<?php

namespace AppBundle\Repository;

/**
 * Class ProjectActionRepository
 * @package AppBundle\Repository
 */
class ProjectActionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
