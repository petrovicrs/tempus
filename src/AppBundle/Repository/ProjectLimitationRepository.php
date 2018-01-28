<?php

namespace AppBundle\Repository;

/**
 * Class ProjectLimitationRepository
 * @package AppBundle\Repository
 */
class ProjectLimitationRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
