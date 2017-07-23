<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\InstitutionAccreditationType;

class InstitutionAccreditationsLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $accreditationType = new InstitutionAccreditationType();
        $accreditationType->setNameEn('type 1');
        $accreditationType->setNameSr('тип 1');
        $manager->persist($accreditationType);

        $accreditationType = new InstitutionAccreditationType();
        $accreditationType->setNameEn('type 2');
        $accreditationType->setNameSr('тип 2');
        $manager->persist($accreditationType);

        // the queries aren't done until now
        $manager->flush();
    }
}