<?php

namespace AppBundle\Repository;

/**
 * Class PersonAddressRepository
 */
class PersonAddressRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personAddress) {

        $this->_em->persist($personAddress);
        $this->_em->flush();
    }

}
