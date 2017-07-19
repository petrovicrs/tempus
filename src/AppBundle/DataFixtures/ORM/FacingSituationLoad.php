<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use AppBundle\Entity\FacingSituation;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FacingSituationLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $facingSituation = new FacingSituation();
        $facingSituation->setNameEn("Cultural Difference");
        $facingSituation->setNameSr("Културолошка разлика");
        $manager->persist($facingSituation);

        $facingSituation = new FacingSituation();
        $facingSituation->setNameEn("Language Barrier");
        $facingSituation->setNameSr("Језичка баријера");
        $manager->persist($facingSituation);

        // the queries aren't done until now
        $manager->flush();
    }
}