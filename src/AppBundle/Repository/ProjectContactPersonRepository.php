<?php

namespace AppBundle\Repository;

/**
 * Class ProjectContactPersonRepository
 * @package AppBundle\Repository
 */
class ProjectContactPersonRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
