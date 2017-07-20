<?php

namespace AppBundle\Repository;

/**
 * Class ProjectSubjectAreaTypeRepository
 * @package AppBundle\Repository
 */
class ProjectSubjectAreaTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
