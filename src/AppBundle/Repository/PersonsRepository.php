<?php

namespace AppBundle\Repository;

/**
 * PersonsRepository
 */
class PersonsRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePerson($person) {

        $this->_em->persist($person);
        $this->_em->flush();
    }
}
