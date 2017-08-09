<?php

namespace AppBundle\Repository;

/**
 * Class ProjectGradeTypeRepository
 * @package AppBundle\Repository
 */
class ProjectGradeTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
