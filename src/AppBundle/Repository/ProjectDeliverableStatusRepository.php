<?php

namespace AppBundle\Repository;

/**
 * Class ProjectDeliverableStatusRepository
 * @package AppBundle\Repository
 */
class ProjectDeliverableStatusRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($status) {

        $this->_em->persist($status);
        $this->_em->flush();
    }

}
