<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 10:54
 */

namespace AppBundle\Repository;


class ResultTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}