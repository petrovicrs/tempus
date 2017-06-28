<?php

namespace AppBundle\Repository;

/**
 * PersonRepository
 */
class PersonRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePerson($person) {

        $this->_em->persist($person);
        $this->_em->flush();
    }
}
