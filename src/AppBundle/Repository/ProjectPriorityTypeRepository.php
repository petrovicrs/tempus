<?php

namespace AppBundle\Repository;

/**
 * Class ProjectPriorityTypeRepository
 * @package AppBundle\Repository
 */
class ProjectPriorityTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
