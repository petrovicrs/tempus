<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 18:05
 */

namespace AppBundle\Repository;


class ActivityRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($activity) {

        $this->_em->persist($activity);
        $this->_em->flush();
    }
}