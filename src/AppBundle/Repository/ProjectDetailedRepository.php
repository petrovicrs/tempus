<?php

namespace AppBundle\Repository;

/**
 * ProjectRepository
 */
class ProjectDetailedRepository extends AbstractRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}
