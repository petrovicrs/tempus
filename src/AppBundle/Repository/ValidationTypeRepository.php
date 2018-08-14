<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 04.02.18
 * Time: 15:20
 */

namespace AppBundle\Repository;


class ValidationTypeRepository extends AbstractRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}