<?php

namespace AppBundle\Repository;

class FacingSituationRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveFacingSituation($object) {

        $this->_em->persist($object);
        $this->_em->flush();
    }

}
