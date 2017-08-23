<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 22:55
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Questions;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ResourceTypeLoad implements FixtureInterface
{
    private $questions = ['Some question no1?', 'Another question about something?'];
    private $questions_sr = ['Neko pitanje broj 1?', 'Jos jedno pitanje o necemu?'];

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < count($this->questions); $i++) {

            $questions = new Questions();

            $questions->setQuestionEn($this->questions[$i]);
            $questions->setQuestionSr($this->questions_sr[$i]);

            $manager->persist($questions);
        }

        $manager->flush();
    }
}