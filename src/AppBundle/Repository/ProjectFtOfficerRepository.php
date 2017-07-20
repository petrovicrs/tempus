<?php

namespace AppBundle\Repository;

/**
 * Class ProjectFtOfficerRepository
 * @package AppBundle\Repository
 */
class ProjectFtOfficerRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
