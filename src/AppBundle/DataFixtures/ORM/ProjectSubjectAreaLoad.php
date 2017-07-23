<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/23/17
 * Time: 2:52 PM
 */

namespace Yoda\EventBundle\DataFixtures\ORM;


use AppBundle\Entity\ProjectSubjectAreaType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ProjectSubjectAreaLoad implements FixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $object = new ProjectSubjectAreaType();
        $object->setNameEn('Test project subject area type 1');
        $object->setNameSr('Тест project subject area type 1');
        $manager->persist($object);

        $object = new ProjectSubjectAreaType();
        $object->setNameEn('Test project subject area type 2');
        $object->setNameSr('Тест project subject area type 2');
        $manager->persist($object);

        // the queries aren't done until now
        $manager->flush();
    }
}