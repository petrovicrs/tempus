<?php

namespace AppBundle\Repository;

/**
 * Class ProjectPriorityRepository
 * @package AppBundle\Repository
 */
class ProjectPriorityRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
