<?php

namespace AppBundle\Repository;

/**
 * Class ProjectProgram
 *
 * @package AppBundle\Repository
 */
class ProjectProgram extends \Doctrine\ORM\EntityRepository {

    /**
     * @param $program
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($program) {
        $this->_em->persist($program);
        $this->_em->flush();
    }

}
