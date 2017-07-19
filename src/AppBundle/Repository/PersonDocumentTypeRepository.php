<?php

namespace AppBundle\Repository;

class PersonDocumentTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePersonDocumentType($documentType) {

        $this->_em->persist($documentType);
        $this->_em->flush();
    }
}
