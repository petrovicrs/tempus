<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 16.08.17
 * Time: 21:52
 */

namespace AppBundle\Repository;


/**
 * Class ReportingPersonRepository
 * @package AppBundle\Repository
 */
class ReportingPersonRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($person) {

        $this->_em->persist($person);
        $this->_em->flush();
    }
}