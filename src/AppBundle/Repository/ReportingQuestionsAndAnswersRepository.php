<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:15
 */

namespace AppBundle\Repository;

/**
 * Class ReportingQuestionsAndAnswersRepository
 * @package AppBundle\Repository
 */
class ReportingQuestionsAndAnswersRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($reportingQuestionAndAnswer) {

        $this->_em->persist($reportingQuestionAndAnswer);
        $this->_em->flush();
    }
}