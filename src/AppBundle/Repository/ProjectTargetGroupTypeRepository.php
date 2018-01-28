<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTargetGroupTypeRepository
 * @package AppBundle\Repository
 */
class ProjectTargetGroupTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
