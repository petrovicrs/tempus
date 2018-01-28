<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTopicTypeRepository
 * @package AppBundle\Repository
 */
class ProjectTopicTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
