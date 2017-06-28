<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Repository\InstitutionRepository;
use AppBundle\Repository\PersonContactRepository;
use AppBundle\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\PersonContactsForm;
use AppBundle\Entity\PersonContact;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PersonContactsController extends Controller
{
    /**
     * @Route("person-contact/list/{person}", name="person_contact_list", requirements={"person": "\d+"})
     */
    public function listAction($person)
    {
        $result = $this->getPersonContactRepository()->findBy(['personId' => $person]);

        return $this->render('person/list.twig', ['result' => $result]);
    }

    /**
     * @Route("/person-contact/create", name="person_contact_create")
     *
     */
    public function createAction(Request $request)
    {
        $personContacts = new PersonContact();

        $personContactsForm = $this->createForm(PersonContactsForm::class, $personContacts, [
            'action' => $this->generateUrl('person_contact_create'),
            'method' => 'POST',
        ]);

        $personContactsForm->handleRequest($request);

        $personId = $personContacts->getPerson();
        $personContacts->setPerson($this->getPersonRepository()->findOneBy(['id' => $personId]));

        if ($personContactsForm->isSubmitted() && $personContactsForm->isValid()) {
            $this->getPersonContactRepository()->saveContact($personContacts);

            return $this->redirectToRoute('person_view', ['personId' => $personId]);

        }

        return $this->render('person-contacts/create.twig', ['my_form' => $personContactsForm->createView()]);
    }

    /**
     * @Route("/person-contact/create/{personId}", name="person_contacts_create_form", requirements={"personId": "\d+"})
     *
     */
    public function createPersonAction($personId)
    {
        $personContacts = new PersonContact();

        $personContactsForm = $this->createForm(PersonContactsForm::class, $personContacts, [
            'action' => $this->generateUrl('person_contact_create'),
            'method' => 'POST',
        ]);

        $person = $this->getPersonRepository()->findBy(['id' => $personId]);

        $personContactsForm->get('person')->setData($personId);

        return $this->render('person-contacts/create.twig', ['my_form' => $personContactsForm->createView()]);
    }

    private function getPersonContactRepository() {

        return $this->get('doctrine_entity_repository.person_contact');
    }

    private function getPersonRepository() {
        return $this->get('doctrine_entity_repository.person');
    }
}