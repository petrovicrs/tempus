<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTargetGroupRepository
 * @package AppBundle\Repository
 */
class ProjectTargetGroupRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
