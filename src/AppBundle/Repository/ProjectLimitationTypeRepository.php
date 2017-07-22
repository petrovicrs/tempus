<?php

namespace AppBundle\Repository;

/**
 * Class ProjectLimitationTypeRepository
 * @package AppBundle\Repository
 */
class ProjectLimitationTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
