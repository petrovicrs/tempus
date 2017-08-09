<?php

namespace AppBundle\Repository;

/**
 * Class ProjectStatusTypeRepository
 * @package AppBundle\Repository
 */
class ProjectStatusTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
