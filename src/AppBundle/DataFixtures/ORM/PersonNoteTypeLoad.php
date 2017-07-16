<?php
namespace Yoda\EventBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PersonNoteType;

class PersonNoteTypeLoad implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('Draft');
        $personNoteType->setNameSr('Нацрт');
        $manager->persist($personNoteType);

        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('Involved at FP7');
        $personNoteType->setNameSr('Ради на FP7');
        $manager->persist($personNoteType);

        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('Unavailable');
        $personNoteType->setNameSr('Недоступан');
        $manager->persist($personNoteType);

        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('Good experince');
        $personNoteType->setNameSr('Добра искуства');
        $manager->persist($personNoteType);

        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('Unreliable');
        $personNoteType->setNameSr('Непоуздан');
        $manager->persist($personNoteType);

        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('FT initials');
        $personNoteType->setNameSr('');
        $manager->persist($personNoteType);

        $personNoteType = new PersonNoteType();
        $personNoteType->setNameEn('Remark related to this person');
        $personNoteType->setNameSr('');
        $manager->persist($personNoteType);


        // the queries aren't done until now
        $manager->flush();
    }
}