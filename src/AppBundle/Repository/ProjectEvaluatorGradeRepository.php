<?php

namespace AppBundle\Repository;

/**
 * Class ProjectEvaluatorGradeRepository
 * @package AppBundle\Repository
 */
class ProjectEvaluatorGradeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($type) {

        $this->_em->persist($type);
        $this->_em->flush();
    }

}
