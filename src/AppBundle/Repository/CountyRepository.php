<?php

namespace AppBundle\Repository;

/**
 * Class CountyRepository
 * @package AppBundle\Repository
 */
class CountyRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($country) {

        $this->_em->persist($country);
        $this->_em->flush();
    }

}
