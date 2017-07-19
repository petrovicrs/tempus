<?php

namespace AppBundle\Repository;

class PersonInstitutionRelationshipTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePersonRelationshipType($documentType) {

        $this->_em->persist($documentType);
        $this->_em->flush();
    }
}
