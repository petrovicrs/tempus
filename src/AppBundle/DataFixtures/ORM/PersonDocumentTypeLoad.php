<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\PersonDocumentType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\User;

class PersonDocumentTypeLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $personDocumentType = new PersonDocumentType();
        $personDocumentType->setTypeEn('ID Card');
        $personDocumentType->setTypeSr('Лична карта');
        $manager->persist($personDocumentType);

        $personDocumentType = new PersonDocumentType();
        $personDocumentType->setTypeEn('Passport');
        $personDocumentType->setTypeSr('Пасош');
        $manager->persist($personDocumentType);

        // the queries aren't done until now
        $manager->flush();
    }
}