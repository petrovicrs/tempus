<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 09.08.17
 * Time: 22:48
 */

namespace AppBundle\Repository;


class IntelectualOutputsTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}