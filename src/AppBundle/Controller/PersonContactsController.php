<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Repository\InstitutionRepository;
use AppBundle\Repository\PersonContactsRepository;
use AppBundle\Repository\PersonsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\PersonContactsForm;
use AppBundle\Entity\PersonContacts;
use AppBundle\Repository\ProjectsRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PersonContactsController extends AbstractController
{

    /**
     * @Route("/{locale}/person-contacts/create", name="person_contacts_create_action", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $personContacts = new PersonContacts();

        $personContactsForm = $this->createForm(PersonContactsForm::class, $personContacts, [
            'action' => $this->generateUrl('person_contacts_create_action'),
            'method' => 'POST',
        ]);

        $personContactsForm->handleRequest($request);

        $personId = $personContacts->getPerson();
        $personContacts->setPerson($this->get('doctrine_entity_repository.persons')->findOneBy(['id' => $personId]));

        if ($personContactsForm->isSubmitted() && $personContactsForm->isValid()) {
            $this->getPersonContactsRepository()->saveContact($personContacts);

            return $this->redirectToRoute('person_view', ['personId' => $personId]);

        }

        return $this->render('person-contacts/create.twig', ['my_form' => $personContactsForm->createView()]);
    }

    /**
     * @Route("/{locale}/person-contacts/create/{personId}", name="person_contacts_create_form", requirements={"personId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function createPersonAction(Request $request, $personId)
    {
        $personContacts = new PersonContacts();

        $personContactsForm = $this->createForm(PersonContactsForm::class, $personContacts, [
            'action' => $this->generateUrl('person_contacts_create_action'),
            'method' => 'POST',
        ]);

        $person = $this->get('doctrine_entity_repository.persons')->findBy(['id' => $personId]);

        $personContactsForm->get('person')->setData($personId);

        return $this->render('person-contacts/create.twig', ['my_form' => $personContactsForm->createView()]);
    }

    private function getPersonContactsRepository() {

        return $this->get('doctrine_entity_repository.person_contacts');
    }
}