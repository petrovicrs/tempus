<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Gender;

class GenderLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $gender = new Gender();
        $gender->setNameEn('Male');
        $gender->setNameSr('Мушки');
        $manager->persist($gender);

        $gender = new Gender();
        $gender->setNameEn('Female');
        $gender->setNameSr('Женски');
        $manager->persist($gender);

        // the queries aren't done until now
        $manager->flush();
    }
}