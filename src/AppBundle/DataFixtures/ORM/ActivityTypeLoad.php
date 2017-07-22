<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 14:39
 */

namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\ActivityType;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\ContactType;

class ActivityTypeLoad implements FixtureInterface
{
    private $types = ['type1', 'type2'];
    private $types_sr = ['тип1', 'тип2'];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->types); $i++) {

            $activityType = new ActivityType();

            $activityType->setNameEn($this->types[$i]);
            $activityType->setNameSr($this->types_sr[$i]);

            $manager->persist($activityType);
        }

        $manager->flush();
    }
}