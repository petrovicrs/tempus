<?php

namespace AppBundle\Repository;

/**
 * PersonContactsRepository
 */
class PersonContactRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveContact($contact) {

        $this->_em->persist($contact);
        $this->_em->flush();
    }
}
