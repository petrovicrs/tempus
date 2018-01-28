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
        $projectKeyAction->setNameEn('ka1');
        $projectKeyAction->setNameSr('ka1');
        $manager->persist($projectKeyAction);

        $projectKeyAction = new ProjectKeyAction();
        $projectKeyAction->setNameEn('ka2');
        $projectKeyAction->setNameSr('ka2');
        $manager->persist($projectKeyAction);

        // the queries aren't done until now
        $manager->flush();
    }
}