<?php

namespace AppBundle\Repository;

/**
 * Class ProjectActivityTypeRepository
 * @package AppBundle\Repository
 */
class ProjectActivityTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
