<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 09.08.17
 * Time: 22:48
 */

namespace AppBundle\Repository;


class IntelectualOutputsRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($intelectualOutput) {

        $this->_em->persist($intelectualOutput);
        $this->_em->flush();
    }
}