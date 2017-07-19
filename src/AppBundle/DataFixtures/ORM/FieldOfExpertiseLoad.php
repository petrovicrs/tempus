<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\FieldOfExpertise;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FieldOfExpertiseLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fieldOfExpertise = new FieldOfExpertise();
        $fieldOfExpertise->setNameEn("Mathematics");
        $fieldOfExpertise->setNameSr("Математика");
        $manager->persist($fieldOfExpertise);

        $fieldOfExpertise = new FieldOfExpertise();
        $fieldOfExpertise->setNameEn("Physics");
        $fieldOfExpertise->setNameSr("Физика");
        $manager->persist($fieldOfExpertise);

        $fieldOfExpertise = new FieldOfExpertise();
        $fieldOfExpertise->setNameEn("Medicine");
        $fieldOfExpertise->setNameSr("Медицина");
        $manager->persist($fieldOfExpertise);

        $fieldOfExpertise = new FieldOfExpertise();
        $fieldOfExpertise->setNameEn("Cardiology");
        $fieldOfExpertise->setNameSr("Кардиологија");
        $manager->persist($fieldOfExpertise);

        // the queries aren't done until now
        $manager->flush();
    }
}