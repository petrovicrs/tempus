<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 15.10.17
 * Time: 10:28
 */

namespace AppBundle\Repository;


class ProjectDeliverablesActivitiesRepository extends AbstractRepository
{
    public function save($project) {

        $this->_em->persist($project);
        $this->_em->flush();
    }
}