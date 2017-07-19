<?php

namespace AppBundle\Repository;

/**
 * PersonFacingSituationRepository
 */
class PersonFacingSituationRepository extends \Doctrine\ORM\EntityRepository
{
    public function savePersonFacingSituation($object) {

        $this->_em->persist($object);
        $this->_em->flush();
    }
}
