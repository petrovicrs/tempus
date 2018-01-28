<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 11:30
 */

namespace AppBundle\Repository;


class ResourcesRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($resource) {
        $this->_em->persist($resource);
        $this->_em->flush();
    }
}