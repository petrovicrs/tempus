<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Repository\InstitutionRepository;
use AppBundle\Repository\PersonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\PersonForm;
use AppBundle\Entity\Persons;
use AppBundle\Repository\ProjectsRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PersonController extends Controller
{
    /**
     * @Route("person/list", name="person_list")
     */
    public function listAction()
    {
        $persons = $this->getPersonsRepository()->findAll();

        return $this->render('person/list.twig', ['persons' => $persons]);
    }

    /**
     * @Route("/person/create", name="person_create")
     *
     */
    public function createAction(Request $request)
    {
        $persons = new Persons();

        $personForm = $this->createForm(PersonForm::class, $persons, [
            'action' => $this->generateUrl('person_create'),
            'method' => 'POST',
        ]);


        $personForm->handleRequest($request);

        if ($personForm->isSubmitted() && $personForm->isValid()) {
            $this->getPersonsRepository()->savePerson($persons);

            return $this->redirectToRoute('person_list');

        }

        return $this->render('person/create.twig', ['my_form' => $personForm->createView()]);
    }

    /**
     * @Route("person/view/{personId}", name="person_view", requirements={"personId": "\d+"})
     */
    public function viewAction($personId)
    {
        $person = $this->getPersonsRepository()->findOneBy(['id' => $personId]);

        $contacts = $this->get('doctrine_entity_repository.person_contacts')->findBy(['person' => $personId]);

        return $this->render('person/view.twig', ['person' => $person, 'contacts' => $contacts]);
    }

    /**
     * @return PersonsRepository
     */
    private function getPersonsRepository() {

        return $this->get('doctrine_entity_repository.persons');
    }
}