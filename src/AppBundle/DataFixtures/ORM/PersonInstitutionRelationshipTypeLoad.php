<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\PersonDocumentType;
use AppBundle\Entity\PersonInstitutionRelationshipType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PersonInstitutionRelationshipTypeLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $personInstitutionRelationshipType = new PersonInstitutionRelationshipType();
        $personInstitutionRelationshipType->setTypeEn('Professor');
        $personInstitutionRelationshipType->setTypeSr('Професор');
        $manager->persist($personInstitutionRelationshipType);

        // the queries aren't done until now
        $manager->flush();
    }
}