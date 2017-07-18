<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Country;

class CountriesLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $country = new Country();
        $country->setNameEn('Aland Islands');
        $country->setNameSr('Аландска острва');
        $manager->persist($country);

        $country = new Country();
        $country->setNameEn('Albania');
        $country->setNameSr('Албанија');
        $manager->persist($country);

        $country = new Country();
        $country->setNameEn('Algeria');
        $country->setNameSr('Алжир');
        $manager->persist($country);

        $country = new Country();
        $country->setNameEn('American Samoa');
        $country->setNameSr('Америчка Самоа');
        $manager->persist($country);

        $country = new Country();
        $country->setNameEn('Andorra');
        $country->setNameSr('Андора');
        $manager->persist($country);

        $country = new Country();
        $country->setNameEn('Angola');
        $country->setNameSr('Ангола');
        $manager->persist($country);

        $country = new Country();
        $country->setNameEn('Anguilla');
        $country->setNameSr('Ангвила');
        $manager->persist($country);

        // the queries aren't done until now
        $manager->flush();
    }
}