<?php

namespace AppBundle\Repository;

/**
 * PicNumberRepository
 */
class PicNumberRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($picNumber) {

        $this->_em->persist($picNumber);
        $this->_em->flush();
    }
}
