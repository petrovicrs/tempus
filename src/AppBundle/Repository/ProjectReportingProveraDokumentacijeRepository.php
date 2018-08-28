<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 12.08.17
 * Time: 21:15
 */

namespace AppBundle\Repository;

/**
 * Class ProjectReportingProveraDokumentacijeRepository
 * @package AppBundle\Repository
 */
class ProjectReportingProveraDokumentacijeRepository extends AbstractRepository
{
    public function save($action) {

        $this->_em->persist($action);
        $this->_em->flush();
    }
}