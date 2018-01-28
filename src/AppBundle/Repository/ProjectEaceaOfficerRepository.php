<?php

namespace AppBundle\Repository;

/**
 * Class ProjectEaceaOfficerRepository
 * @package AppBundle\Repository
 */
class ProjectEaceaOfficerRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
