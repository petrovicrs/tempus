<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\PersonContact;
use AppBundle\Repository\PersonContactRepository;
use AppBundle\Repository\PersonRepository;
use AppBundle\Form\PersonForm;
use AppBundle\Entity\Person;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


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
            'locale' => $request->getLocale(),
        ]);


        $personForm->handleRequest($request);

        if ($personForm->isSubmitted()  && $personForm->isValid()) {
            $this->getPersonRepository()->savePerson($persons);

            /** @var PersonContact $contact */
            foreach($persons->getContacts() as $contact){
                $contact->setPerson($persons);
                $this->getPersonContactRepository()->saveContact($contact);
            }

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
     * @Route("/{locale}/person/edit/{personId}", name="person_edit", requirements={"personId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $personId)
    {
        $person = $this->getPersonRepository()->findOneBy(['id' => $personId]);

        $projectForm = $this->createForm(PersonForm::class, $person, [
            'action' => $this->generateUrl('person_edit', ['personId' => $personId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $originalContacts = new ArrayCollection();

        // Create an ArrayCollection of the current PersonContact objects in the database
        foreach ($person->getContacts() as $contact) {
            $originalContacts->add($contact);
        }

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // remove the relationship between the tag and the Task
            foreach ($originalContacts as $contact) {
                if (false === $person->getContacts()->contains($contact)) {
                     $em->remove($contact);
                }
            }


            $this->getPersonRepository()->savePerson($person);

            return $this->redirectToRoute('person_list');
        }

        return $this->render('person/edit.twig', ['my_form' => $projectForm->createView()]);
    }


    /**
     * @return PersonRepository
     */
    private function getPersonRepository() {

        return $this->get('doctrine_entity_repository.person');
    }



    /**
     * @return PersonContactRepository
     */
    private function getPersonContactRepository() {

        return $this->get('doctrine_entity_repository.person_contact');
    }


}