<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 10:54
 */

namespace AppBundle\Repository;


class ResultsRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($result) {
        $this->_em->persist($result);
        $this->_em->flush();
    }
}