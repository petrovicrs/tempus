<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTypeRepository
 * @package AppBundle\Repository
 */
class ProjectTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($projectType) {

        $this->_em->persist($projectType);
        $this->_em->flush();
    }

}
