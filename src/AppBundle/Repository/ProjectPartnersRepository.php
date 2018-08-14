<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 15:50
 */

namespace AppBundle\Repository;

/**
 * Class ProjectPartnersRepository
 */
class ProjectPartnersRepository extends AbstractRepository
{
    public function save($project) {

        $this->_em->persist($project);
        $this->_em->flush();
    }
}