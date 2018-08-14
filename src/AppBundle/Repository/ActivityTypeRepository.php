<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 14:58
 */

namespace AppBundle\Repository;


class ActivityTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}