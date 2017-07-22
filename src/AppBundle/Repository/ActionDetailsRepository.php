<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 18:05
 */

namespace AppBundle\Repository;


class ActionDetailsRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveAction($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}