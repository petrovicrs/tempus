<?php

namespace AppBundle\Repository;

/**
 * Class ProjectDeliverableTypeRepository
 * @package AppBundle\Repository
 */
class ProjectDeliverableTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
