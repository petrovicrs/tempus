<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTypeOfLimitationRepository
 * @package AppBundle\Repository
 */
class ProjectTypeOfLimitationRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
