<?php

namespace AppBundle\Repository;

/**
 * ProjectsRepository
 */
class ProjectsRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveProject($project) {

        $this->_em->persist($project);
        $this->_em->flush();
    }

}
