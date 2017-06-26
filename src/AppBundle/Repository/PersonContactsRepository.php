<?php

namespace AppBundle\Repository;

/**
 * PersonContactsRepository
 */
class PersonContactsRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveContact($contact) {

        $this->_em->persist($contact);
        $this->_em->flush();
    }
}
