<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 15.10.17
 * Time: 10:28
 */

namespace AppBundle\Repository;


class ProjectMobilityFlowsRepository extends AbstractRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}