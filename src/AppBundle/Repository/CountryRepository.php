<?php

namespace AppBundle\Repository;

/**
 * Class CountryRepository
 * @package AppBundle\Repository
 */
class CountryRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($country) {

        $this->_em->persist($country);
        $this->_em->flush();
    }

}
