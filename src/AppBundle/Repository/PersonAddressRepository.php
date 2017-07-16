<?php

namespace AppBundle\Repository;

/**
 * Class PersonAddressRepository
 * @package AppBundle\Repository
 */
class PersonAddressRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personAddress) {

        $this->_em->persist($personAddress);
        $this->_em->flush();
    }

}
