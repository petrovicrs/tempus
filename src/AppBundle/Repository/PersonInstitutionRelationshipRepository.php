<?php

namespace AppBundle\Repository;

class PersonInstitutionRelationshipRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePersonInstitutionRelationship($object) {

        $this->_em->persist($object);
        $this->_em->flush();
    }
}
