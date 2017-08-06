<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\ProjectApplicantOrganisation;
use AppBundle\Entity\ProjectContactPerson;
use AppBundle\Entity\ProjectKeyAction;
use AppBundle\Entity\ProjectLimitation;
use AppBundle\Entity\ProjectNote;
use AppBundle\Entity\ProjectPartnerOrganisation;
use AppBundle\Entity\ProjectSubjectArea;
use AppBundle\Entity\ProjectTopic;
use AppBundle\Repository\ProjectSubjectAreaRepository;
use AppBundle\Repository\ProjectTopicRepository;
use PhpOption\Tests\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\ProjectForm;
use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;
use AppBundle\Repository\ProjectApplicantOrganisationRepository;
use AppBundle\Repository\ProjectPartnerOrganisationRepository;
use AppBundle\Repository\ProjectLimitationRepository;
use AppBundle\Repository\ProjectNoteRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="default_route")
     * @Route("/{locale}/project/list", name="project_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {//* @Security("is_granted('ROLE_ADMIN')")
        $result = $this->getProjectRepository()->findAll();

        return $this->render('project/list.twig', ['result' => $result]);
    }

    /**
     * @Route("/{locale}/project/create", name="project_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $project = new Project();
        $keyActionSelected = $request->request->get('project_key_action');

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid())
        {
            $this->getProjectRepository()->saveProject($project);

            /** @var ProjectApplicantOrganisation $applicantOrganisation */
            foreach($project->getApplicantOrganisations() as $applicantOrganisation){
                $applicantOrganisation->setProject($project);
                $this->getApplicantOrganisationRepository()->save($applicantOrganisation);
            }

            /** @var ProjectPartnerOrganisation $partnerOrganisation */
            foreach($project->getPartnerOrganisations() as $partnerOrganisation){
                $partnerOrganisation->setProject($project);
                $this->getProjectPartnerOrganisationRepository()->save($partnerOrganisation);
            }

            /** @var ProjectLimitation $limitation */
            foreach($project->getLimitations() as $limitation){
                $limitation->setProject($project);
                $this->getProjectLimitationRepository()->save($limitation);
            }

            /** @var ProjectContactPerson $contactPerson */
            foreach($project->getContactPersons() as $contactPerson){
                $contactPerson->setProject($project);
                $this->getProjectContactPersonRepository()->save($contactPerson);
            }

            /** @var ProjectTopic $topic */
            foreach($project->getTopics() as $topic){
                $topic->setProject($project);
                $this->getProjectTopicRepository()->save($topic);
            }

            /** @var ProjectSubjectArea $subjectArea */
            foreach($project->getSubjectAreas() as $subjectArea){
                $subjectArea->setProject($project);
                $this->getProjectSubjectAreasRepository()->save($subjectArea);
            }

            /** @var ProjectNote $note */
            foreach($project->getNotes() as $note){
                $note->setProject($project);
                $this->getProjectNotesRepository()->save($note);
            }

            return $this->redirectToRoute('project_list');

        }

        $data = [
            'my_form' => $projectForm->createView()
        ];

        if(!is_null($keyActionSelected)) {
            $keyAction = $this->getProjectKeyActionRepository()->findOneBy(['id' => (int) $keyActionSelected]);
            // TODO check what to pass to form (id, name, or something else)
            $data['key_action_selected'] = $keyAction->getId();//$keyAction->getName($request->getLocale());
        }

        return $this->render('project/create.twig', $data);
    }

    /**
     * @Route("/{locale}/project/edit/{projectId}", name="project_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);
        $keyActionSelected = $request->request->get('project_key_action');

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_edit', ['projectId' => $projectId]),
            'method' => 'POST',
        ]);

        $originalApplicantOrganisations = new ArrayCollection();
        $originalPartnerOrganisations = new ArrayCollection();
        $originalLimitations = new ArrayCollection();
        $originalContactPersons = new ArrayCollection();
        $originalTopics = new ArrayCollection();
        $originalSubjectAreas = new ArrayCollection();
        $originalNotes = new ArrayCollection();

        foreach ($project->getApplicantOrganisations() as $applicantOrganisation) {
            $originalApplicantOrganisations->add($applicantOrganisation);
        }

        foreach ($project->getPartnerOrganisations() as $partnerOrganisation){
            $originalPartnerOrganisations->add($partnerOrganisation);
        }

        foreach ($project->getLimitations() as $limitation){
            $originalLimitations->add($limitation);
        }

        foreach ($project->getContactPersons() as $contactPerson){
            $originalContactPersons->add($contactPerson);
        }

        foreach ($project->getTopics() as $topic){
            $originalTopics->add($topic);
        }

        foreach ($project->getSubjectAreas() as $subjectArea){
            $originalSubjectAreas->add($subjectArea);
        }

        foreach ($project->getNotes() as $note){
            $originalNotes->add($note);
        }

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($originalApplicantOrganisations as $applicantOrganisation) {
                if (false === $project->getApplicantOrganisations()->contains($applicantOrganisation)) {
                    $em->remove($applicantOrganisation);
                }
            }

            /** @var ProjectApplicantOrganisation $applicantOrganisation */
            foreach ($project->getApplicantOrganisations() as $applicantOrganisation) {
                if (false === $originalApplicantOrganisations->contains($applicantOrganisation)) {
                    $applicantOrganisation->setProject($project);
                    $this->getApplicantOrganisationRepository()->save($applicantOrganisation);
                }
            }

            foreach ($originalPartnerOrganisations as $originalPartnerOrganisation) {
                if (false === $project->getPartnerOrganisations()->contains($originalPartnerOrganisation)) {
                    $em->remove($originalPartnerOrganisation);
                }
            }

            /** @var ProjectPartnerOrganisation $partnerOrganisation */
            foreach ($project->getPartnerOrganisations() as $partnerOrganisation) {
                if (false === $originalPartnerOrganisations->contains($partnerOrganisation)) {
                    $partnerOrganisation->setProject($project);
                    $this->getProjectPartnerOrganisationRepository()->save($partnerOrganisation);
                }
            }

            foreach ($originalLimitations as $originalLimitation) {
                if (false === $project->getLimitations()->contains($originalLimitation)) {
                    $em->remove($originalLimitation);
                }
            }

            /** @var ProjectLimitation $limitation */
            foreach ($project->getLimitations() as $limitation) {
                if (false === $originalNotes->contains($limitation)) {
                    $limitation->setProject($project);
                    $this->getProjectLimitationRepository()->save($limitation);
                }
            }

            foreach ($originalContactPersons as $originalContactPerson) {
                if (false === $project->getContactPersons()->contains($originalContactPerson)) {
                    $em->remove($originalContactPerson);
                }
            }

            /** @var ProjectContactPerson $contactPerson */
            foreach ($project->getContactPersons() as $contactPerson) {
                if (false === $originalContactPersons->contains($contactPerson)) {
                    $contactPerson->setProject($project);
                    $this->getProjectContactPersonRepository()->save($contactPerson);
                }
            }

            foreach ($originalTopics as $originalTopic) {
                if (false === $project->getTopics()->contains($originalTopic)) {
                    $em->remove($originalTopic);
                }
            }

            /** @var ProjectTopic $topic */
            foreach ($project->getTopics() as $topic) {
                if (false === $originalTopics->contains($topic)) {
                    $topic->setProject($project);
                    $this->getProjectTopicRepository()->save($topic);
                }
            }

            foreach ($originalSubjectAreas as $originalSubjectArea) {
                if (false === $project->getSubjectAreas()->contains($originalSubjectArea)) {
                    $em->remove($originalSubjectArea);
                }
            }

            /** @var ProjectSubjectArea $subjectArea */
            foreach ($project->getSubjectAreas() as $subjectArea) {
                if (false === $originalSubjectAreas->contains($subjectArea)) {
                    $subjectArea->setProject($project);
                    $this->getProjectTopicRepository()->save($subjectArea);
                }
            }

            foreach ($originalNotes as $originalNote) {
                if (false === $project->getNotes()->contains($originalNote)) {
                    $em->remove($originalNote);
                }
            }

            /** @var ProjectNote $note */
            foreach ($project->getNotes() as $note) {
                if (false === $originalNotes->contains($note)) {
                    $note->setProject($project);
                    $this->getProjectTopicRepository()->save($note);
                }
            }

            $this->getProjectRepository()->saveProject($project);

            return $this->redirectToRoute('project_list');
        }

        $data = [
            'my_form' => $projectForm->createView()
        ];

        if(!is_null($keyActionSelected)) {
            $keyAction = $this->getProjectKeyActionRepository()->findOneBy(['id' => (int) $keyActionSelected]);
            // TODO check what to pass to form (id, name, or something else)
            $data['key_action_selected'] = $keyAction->getId();//$keyAction->getName($request->getLocale());
        }

        return $this->render('project/edit.twig', $data);
    }

    /**
     * @Route("/{locale}/project/{projectId}", name="project_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     * }
     */
    public function viewProjectAction($projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (!$project) {
            throw $this->createNotFoundException(
                'No project found for id '. $projectId
            );
        }

        $originalApplicantOrganisations = new ArrayCollection();
        $originalPartnerOrganisations = new ArrayCollection();
        $originalLimitations = new ArrayCollection();
        $originalContactPersons = new ArrayCollection();
        $originalTopics = new ArrayCollection();
        $originalSubjectAreas = new ArrayCollection();
        $originalNotes = new ArrayCollection();

        foreach ($project->getApplicantOrganisations() as $applicantOrganisation) {
            $originalApplicantOrganisations->add($applicantOrganisation);
        }

        foreach ($project->getPartnerOrganisations() as $partnerOrganisation){
            $originalPartnerOrganisations->add($partnerOrganisation);
        }

        foreach ($project->getLimitations() as $limitation){
            $originalLimitations->add($limitation);
        }

        foreach ($project->getContactPersons() as $contactPerson){
            $originalContactPersons->add($contactPerson);
        }

        foreach ($project->getTopics() as $topic){
            $originalTopics->add($topic);
        }

        foreach ($project->getSubjectAreas() as $subjectArea){
            $originalSubjectAreas->add($subjectArea);
        }

        foreach ($project->getNotes() as $note){
            $originalNotes->add($note);
        }

        return $this->render('project/view.twig', ['project' => $project]);
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }

    /**
     * @return ProjectKeyActionRepository
     */
    private function getProjectKeyActionRepository() {

        return $this->get('doctrine_entity_repository.project_key_action');
    }

    /**
     * @return ProjectApplicantOrganisationRepository
     */
    private function getApplicantOrganisationRepository() {

        return $this->get('doctrine_entity_repository.project_applicant_organisation');
    }

    /**
     * @return ProjectPartnerOrganisationRepository
     */
    private function getProjectPartnerOrganisationRepository() {

        return $this->get('doctrine_entity_repository.project_partner_organisation');
    }

    /**
     * @return ProjectLimitationRepository
     */
    private function getProjectLimitationRepository() {

        return $this->get('doctrine_entity_repository.project_limitation');
    }

    /**
     * @return ProjectLimitationRepository
     */
    private function getProjectContactPersonRepository() {

        return $this->get('doctrine_entity_repository.project_contact_persons');
    }

    /**
     * @return ProjectTopicRepository
     */
    private function getProjectTopicRepository() {

        return $this->get('doctrine_entity_repository.project_topics');
    }

    /**
     * @return ProjectSubjectAreaRepository
     */
    private function getProjectSubjectAreasRepository() {

        return $this->get('doctrine_entity_repository.project_subject_areas');
    }

    /**
     * @return ProjectNoteRepository
     */
    private function getProjectNotesRepository() {

        return $this->get('doctrine_entity_repository.project_notes');
    }

}