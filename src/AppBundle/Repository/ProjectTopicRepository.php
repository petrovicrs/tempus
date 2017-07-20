<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTopicRepository
 * @package AppBundle\Repository
 */
class ProjectTopicRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
