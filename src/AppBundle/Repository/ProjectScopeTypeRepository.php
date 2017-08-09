<?php

namespace AppBundle\Repository;

/**
 * Class ProjectScopeTypeRepository
 * @package AppBundle\Repository
 */
class ProjectScopeTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
