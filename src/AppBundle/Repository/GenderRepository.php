<?php

namespace AppBundle\Repository;

/**
 * Class GenderRepository
 * @package AppBundle\Repository
 */
class GenderRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($gender) {

        $this->_em->persist($gender);
        $this->_em->flush();
    }

}
