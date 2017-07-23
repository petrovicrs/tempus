<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\ProjectKeyAction;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectKeyActionLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $projectKeyAction = new ProjectKeyAction();
        $projectKeyAction->setNameEn('Test key action 1');
        $projectKeyAction->setNameSr('Тест 1');
        $manager->persist($projectKeyAction);

        $projectKeyAction = new ProjectKeyAction();
        $projectKeyAction->setNameEn('Test key action 2');
        $projectKeyAction->setNameSr('Тест 2');
        $manager->persist($projectKeyAction);

        // the queries aren't done until now
        $manager->flush();
    }
}