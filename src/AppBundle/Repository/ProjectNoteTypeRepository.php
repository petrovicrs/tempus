<?php

namespace AppBundle\Repository;

/**
 * Class ProjectNoteTypeRepository
 * @package AppBundle\Repository
 */
class ProjectNoteTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
