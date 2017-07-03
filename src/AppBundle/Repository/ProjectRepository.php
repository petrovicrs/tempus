<?php

namespace AppBundle\Repository;

/**
 * ProjectRepository
 */
class ProjectRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveProject($project) {

        $this->_em->persist($project);
        $this->_em->flush();
    }

}
