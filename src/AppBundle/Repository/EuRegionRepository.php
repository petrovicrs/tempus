<?php

namespace AppBundle\Repository;

/**
 * Class EuRegionRepository
 * @package AppBundle\Repository
 */
class EuRegionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($country) {

        $this->_em->persist($country);
        $this->_em->flush();
    }

}
