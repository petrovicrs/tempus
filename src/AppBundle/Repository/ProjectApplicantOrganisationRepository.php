<?php

namespace AppBundle\Repository;

/**
 * Class ProjectApplicantOrganisationRepository
 * @package AppBundle\Repository
 */
class ProjectApplicantOrganisationRepository extends \Doctrine\ORM\EntityRepository
{
    public function save($personNoteType) {

        $this->_em->persist($personNoteType);
        $this->_em->flush();
    }

}
