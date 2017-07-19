<?php

namespace AppBundle\Repository;

/**
 * Class ProjectProgrammeRepository
 * @package AppBundle\Repository
 */
class ProjectProgrammeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
