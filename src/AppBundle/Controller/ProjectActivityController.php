<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\ProjectActivity;
use AppBundle\Form\ProjectActivityForm;
use AppBundle\Repository\ProjectActivityRepository;
use AppBundle\Repository\ProjectDeliverableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


class ProjectActivityController extends AbstractController
{
    /**
     * @Route("/{locale}/activities/list/{projectId}", name="project_activities_list", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function listAction($projectId)
    {
        $activities = $this->getActivitiesRepository()->findBy(['projectId' => $projectId]);
        $deliverables = $this->getDeliverablesRepository()->findBy(['projectId' => $projectId]);

        return $this->render('project_activity/list.twig', ['activities' => $activities,
            'deliverables' => $deliverables, 'projectId' => $projectId]);
    }

    /**
     * @Route("/{locale}/activities/create", name="project_activity_create", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $projectActivity = new ProjectActivity();

        $activityForm = $this->createForm(ProjectActivityForm::class, null, [
            'action' => $this->generateUrl('project_activity_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $activityForm->handleRequest($request);

        if ($activityForm->isSubmitted()  && $activityForm->isValid()) {

            return $this->redirectToRoute('project_activity_create');

        }

        return $this->render('project_activity/create.twig', ['my_form' => $activityForm->createView()]);
    }

    /**
     * @Route("/{locale}/activities/view/{activityId}", name="activity_view", requirements={"activityId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($personId)
    {
        $person = $this->getPersonRepository()->findOneBy(['id' => $personId]);

        $contacts = $this->get('doctrine_entity_repository.person_contact')->findBy(['person' => $personId]);

        return $this->render('person/view.twig', ['person' => $person, 'contacts' => $contacts]);
    }



    /**
     * @Route("/{locale}/activity/edit/{activityId}", name="activity_edit", requirements={"activityId": "\d+", "locale": "%app.locales%"})
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
     * @return ProjectActivityRepository
     */
    private function getActivitiesRepository() {

        return $this->get('doctrine_entity_repository.project_activities');
    }

    /**
     * @return ProjectDeliverableRepository
     */
    private function getDeliverablesRepository() {

        return $this->get('doctrine_entity_repository.project_deliverables');
    }
}