<?php

namespace AppBundle\Repository;


class DifficultyTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($difficulty) {

        $this->_em->persist($difficulty);
        $this->_em->flush();
    }
}