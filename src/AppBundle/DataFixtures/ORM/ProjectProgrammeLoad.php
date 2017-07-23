<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\ProjectProgramme;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectProgrammeLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $projectProgramme = new ProjectProgramme();
        $projectProgramme->setNameEn('Test programme 1');
        $projectProgramme->setNameSr('Тест програм 1');
        $manager->persist($projectProgramme);

        $projectProgramme = new ProjectProgramme();
        $projectProgramme->setNameEn('Test programme 2');
        $projectProgramme->setNameSr('Тест програм 2');
        $manager->persist($projectProgramme);

        // the queries aren't done until now
        $manager->flush();
    }
}