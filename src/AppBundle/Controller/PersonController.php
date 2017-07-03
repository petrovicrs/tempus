<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Repository\InstitutionRepository;
use AppBundle\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\PersonForm;
use AppBundle\Entity\Person;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PersonController extends AbstractController
{
    /**
     * @Route("/{locale}/person/list", name="person_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $persons = $this->getPersonRepository()->findAll();

        return $this->render('person/list.twig', ['persons' => $persons]);
    }

    /**
     * @Route("/{locale}/person/create", name="person_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $persons = new Person();

        $personForm = $this->createForm(PersonForm::class, $persons, [
            'action' => $this->generateUrl('person_create'),
            'method' => 'POST',
        ]);


        $personForm->handleRequest($request);

        if ($personForm->isSubmitted() && $personForm->isValid()) {
            $this->getPersonRepository()->savePerson($persons);

            return $this->redirectToRoute('person_list');

        }

        return $this->render('person/create.twig', ['my_form' => $personForm->createView()]);
    }

    /**
     * @Route("/{locale}/person/view/{personId}", name="person_view", requirements={"personId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($personId)
    {
        $person = $this->getPersonRepository()->findOneBy(['id' => $personId]);

        $contacts = $this->get('doctrine_entity_repository.person_contact')->findBy(['person' => $personId]);

        return $this->render('person/view.twig', ['person' => $person, 'contacts' => $contacts]);
    }

    /**
     * @return PersonRepository
     */
    private function getPersonRepository() {

        return $this->get('doctrine_entity_repository.person');
    }
}