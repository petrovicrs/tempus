<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:15
 */

namespace AppBundle\Repository;

/**
 * Class ReportingTypeRepository
 * @package AppBundle\Repository
 */
class ReportingTypeRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($reportingType) {

        $this->_em->persist($reportingType);
        $this->_em->flush();
    }
}