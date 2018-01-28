<?php

namespace AppBundle\Repository;

/**
 * Class ProjectSubjectAreaRepository
 * @package AppBundle\Repository
 */
class ProjectSubjectAreaRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
