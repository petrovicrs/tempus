<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 14:58
 */

namespace AppBundle\Repository;


class ExistingProjectPermissionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($c) {
        $this->_em->persist($c);
        $this->_em->flush();
    }
}