<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\PersonAddress;
use AppBundle\Entity\PersonContact;
use AppBundle\Entity\PersonDocument;
use AppBundle\Entity\PersonFacingSituation;
use AppBundle\Entity\PersonInstitutionRelationship;
use AppBundle\Entity\PersonNote;
use AppBundle\Repository\PersonAddressRepository;
use AppBundle\Repository\PersonContactRepository;
use AppBundle\Repository\PersonDocumentRepository;
use AppBundle\Repository\PersonFacingSituationRepository;
use AppBundle\Repository\PersonInstitutionRelationshipRepository;
use AppBundle\Repository\PersonNoteRepository;
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

            /** @var PersonAddress $personAddress */
            foreach($persons->getAddresses() as $personAddress){
                $personAddress->setPerson($persons);
                $this->getPersonAddressRepository()->save($personAddress);
            }

            /** @var PersonNote $personNote */
            foreach($persons->getPersonNotes() as $personNote){
                $personNote->setPerson($persons);
                $this->getPersonNoteRepository()->save($personNote);
            }

            /** @var PersonDocument $document */
            foreach($persons->getPersonDocuments() as $document){
                $document->setPerson($persons);
                $this->getPersonDocumentRepository()->savePersonDocument($document);
            }

            /** @var PersonInstitutionRelationship $personInstitutionRelationship */
            foreach($persons->getPersonInstitutionRelationships() as $personInstitutionRelationship){
                $personInstitutionRelationship->setPerson($persons);
                $this->getPersonInstitutionRelationshipRepository()->savePersonInstitutionRelationship($personInstitutionRelationship);
            }


            /** @var PersonFacingSituation $personFacingSituation */
            foreach($persons->getPersonFacingSituations() as $personFacingSituation){
                $personFacingSituation->setPerson($persons);
                $this->getPersonFacingSituationRepository()->savePersonFacingSituation($personFacingSituation);
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
        /** @var Person $person */
        $person = $this->getPersonRepository()->findOneBy(['id' => $personId]);

        $projectForm = $this->createForm(PersonForm::class, $person, [
            'action' => $this->generateUrl('person_edit', ['personId' => $personId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $originalContacts = new ArrayCollection();
        $originalAddresses = new ArrayCollection();
        $originalNotes = new ArrayCollection();
        $originalDocuments = new ArrayCollection();
        $originalPersonInstitutionRelationships = new ArrayCollection();
        $originalPersonFacingSituations = new ArrayCollection();

        // Create an ArrayCollection of the current PersonContact objects in the database
        foreach ($person->getContacts() as $contact) {
            $originalContacts->add($contact);
        }

        foreach ($person->getAddresses() as $address){
            $originalAddresses->add($address);
        }

        foreach ($person->getPersonNotes() as $note){
            $originalNotes->add($note);
        }

        foreach ($person->getPersonDocuments() as $document){
            $originalDocuments->add($document);
        }

        foreach ($person->getPersonInstitutionRelationships() as $personInstitutionRelationship){
            $originalPersonInstitutionRelationships->add($personInstitutionRelationship);
        }

        foreach ($person->getPersonFacingSituations() as $personFacingSituation){
            $originalPersonFacingSituations->add($personFacingSituation);
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

            /** @var PersonContact $contact */
            foreach ($person->getContacts() as $contact) {
                if (false === $originalContacts->contains($contact)) {
                    $contact->setPerson($person);
                    $this->getPersonContactRepository()->saveContact($contact);
                }
            }

            foreach ($originalAddresses as $address) {
                if (false === $person->getAddresses()->contains($address)) {
                    $em->remove($address);
                }
            }

            /** @var PersonAddress $address */
            foreach ($person->getAddresses() as $address) {
                if (false === $originalAddresses->contains($address)) {
                    $address->setPerson($person);
                    $this->getPersonAddressRepository()->save($address);
                }
            }

            foreach ($originalNotes as $note) {
                if (false === $person->getPersonNotes()->contains($note)) {
                    $em->remove($note);
                }
            }

            /** @var PersonNote $note */
            foreach ($person->getPersonNotes() as $note) {
                if (false === $originalNotes->contains($note)) {
                    $note->setPerson($person);
                    $this->getPersonNoteRepository()->save($note);
                }
            }

            foreach ($originalDocuments as $document) {
                if (false === $person->getPersonDocuments()->contains($document)) {
                    $em->remove($document);
                }
            }

            /** @var PersonDocument $document */
            foreach ($person->getPersonDocuments() as $document) {
                if (false === $originalDocuments->contains($document)) {
                    $document->setPerson($person);
                    $this->getPersonDocumentRepository()->savePersonDocument($document);
                }
            }

            foreach ($originalPersonInstitutionRelationships as $personInstitutionRelationship) {
                if (false === $person->getPersonInstitutionRelationships()->contains($personInstitutionRelationship)) {
                    $em->remove($personInstitutionRelationship);
                }
            }

            /** @var PersonInstitutionRelationship $personInstitutionRelationship */
            foreach ($person->getPersonInstitutionRelationships() as $personInstitutionRelationship) {
                if (false === $originalPersonInstitutionRelationships->contains($personInstitutionRelationship)) {
                    $personInstitutionRelationship->setPerson($person);
                    $this->getPersonInstitutionRelationshipRepository()->savePersonInstitutionRelationship($personInstitutionRelationship);
                }
            }

            foreach ($originalPersonInstitutionRelationships as $personInstitutionRelationship) {
                if (false === $person->getPersonInstitutionRelationships()->contains($personInstitutionRelationship)) {
                    $em->remove($personInstitutionRelationship);
                }
            }

            /** @var PersonFacingSituation $personFacingSituation */
            foreach ($person->getPersonFacingSituations() as $personFacingSituation) {
                if (false === $originalPersonFacingSituations->contains($personFacingSituation)) {
                    $personFacingSituation->setPerson($person);
                    $this->getPersonFacingSituationRepository()->savePersonFacingSituation($personFacingSituation);
                }
            }

            foreach ($originalPersonFacingSituations as $personFacingSituation) {
                if (false === $person->getPersonFacingSituations()->contains($personFacingSituation)) {
                    $em->remove($personFacingSituation);
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

    /**
     * @return PersonAddressRepository
     */
    private function getPersonAddressRepository() {

        return $this->get('doctrine_entity_repository.person_address');
    }


    /**
     * @return PersonNoteRepository
     */
    private function getPersonNoteRepository() {

        return $this->get('doctrine_entity_repository.person_note');
    }

    /**
     * @return PersonDocumentRepository
     */
    private function getPersonDocumentRepository() {

        return $this->get('doctrine_entity_repository.person_document');
    }

    /**
     * @return PersonInstitutionRelationshipRepository
     */
    private function getPersonInstitutionRelationshipRepository() {

        return $this->get('doctrine_entity_repository.person_institution_relationship');
    }

    /**
     * @return PersonFacingSituationRepository
     */
    private function getPersonFacingSituationRepository() {

        return $this->get('doctrine_entity_repository.person_facing_situation');
    }
}