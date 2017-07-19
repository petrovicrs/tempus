<?php

namespace AppBundle\Repository;

class FieldOfExpertiseRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveFieldOfExpertise($object) {

        $this->_em->persist($object);
        $this->_em->flush();
    }

}
