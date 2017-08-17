<?php

namespace AppBundle\Repository;

/**
 * Class ProjectActivityStatusRepository
 * @package AppBundle\Repository
 */
class ProjectActivityStatusRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($status) {

        $this->_em->persist($status);
        $this->_em->flush();
    }

}
