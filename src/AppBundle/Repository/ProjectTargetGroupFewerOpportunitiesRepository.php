<?php

namespace AppBundle\Repository;

/**
 * Class ProjectTargetGroupFewerOpportunitiesRepository
 * @package AppBundle\Repository
 */
class ProjectTargetGroupFewerOpportunitiesRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
