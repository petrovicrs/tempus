<?php

namespace AppBundle\Repository;

/**
 * Class ProjectActivityRepository
 * @package AppBundle\Repository
 */
class ProjectActivityRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($activity) {

        $this->_em->persist($activity);
        $this->_em->flush();
    }

}
