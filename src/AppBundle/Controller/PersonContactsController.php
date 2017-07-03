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

class PersonContactsController extends AbstractController
{

    /**
     * @Route("/{locale}/person-contacts/create", name="person_contacts_create_action", requirements={"locale": "%app.locales%"})
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
     * @Route("/{locale}/person-contacts/create/{personId}", name="person_contacts_create_form", requirements={"personId": "\d+", "locale": "%app.locales%"})
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