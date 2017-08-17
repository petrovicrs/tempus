<?php

namespace AppBundle\Repository;

/**
 * Class ProjectDeliverableRepository
 * @package AppBundle\Repository
 */
class ProjectDeliverableRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($status) {

        $this->_em->persist($status);
        $this->_em->flush();
    }

}
