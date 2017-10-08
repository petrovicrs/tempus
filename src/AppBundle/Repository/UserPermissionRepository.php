<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 14:58
 */

namespace AppBundle\Repository;


class UserPermissionRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($permission) {

        $this->_em->persist($permission);
        $this->_em->flush();
    }
}