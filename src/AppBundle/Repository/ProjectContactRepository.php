<?php

namespace AppBundle\Repository;

/**
 * Class ProjectContactRepository
 * @package AppBundle\Repository
 */
class ProjectContactRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
