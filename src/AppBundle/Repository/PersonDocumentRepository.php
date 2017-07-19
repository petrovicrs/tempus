<?php

namespace AppBundle\Repository;

class PersonDocumentRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePersonDocument($personDocument) {

        $this->_em->persist($personDocument);
        $this->_em->flush();
    }
}
