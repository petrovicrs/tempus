<?php

namespace AppBundle\Repository;

/**
 * Class ProjectRoundRepository
 * @package AppBundle\Repository
 */
class ProjectRoundRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
