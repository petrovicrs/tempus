<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\ProjectApplicantOrganisation;
use AppBundle\Entity\ProjectContact;
use AppBundle\Entity\ProjectContactPerson;
use AppBundle\Entity\ProjectEvaluatorGrade;
use AppBundle\Entity\ProjectKeyAction;
use AppBundle\Entity\ProjectLimitation;
use AppBundle\Entity\ProjectNote;
use AppBundle\Entity\ProjectPartnerOrganisation;
use AppBundle\Entity\ProjectPriority;
use AppBundle\Entity\ProjectSubjectArea;
use AppBundle\Entity\ProjectTargetGroup;
use AppBundle\Entity\ProjectTopic;
use AppBundle\Entity\ProjectStart;
use AppBundle\Repository\ProjectContactRepository;
use AppBundle\Repository\ProjectSubjectAreaRepository;
use AppBundle\Repository\ProjectTargetGroupFewerOpportunitiesRepository;
use AppBundle\Repository\ProjectTargetGroupRepository;
use AppBundle\Repository\ProjectTopicRepository;
use AppBundle\Repository\ProjectStartRepository;
use PhpOption\Tests\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\ProjectForm;
use AppBundle\Form\ProjectKa2Form;
use AppBundle\Form\ProjectStartForm;
use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;
use AppBundle\Repository\ProjectApplicantOrganisationRepository;
use AppBundle\Repository\ProjectPartnerOrganisationRepository;
use AppBundle\Repository\ProjectLimitationRepository;
use AppBundle\Repository\ProjectEvaluatorGradeRepository;
use AppBundle\Repository\ProjectPriorityRepository;
use AppBundle\Repository\ProjectTargetGroupTypeRepository;
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
     * @Route("/statistic", name="statistic_route")
     */
    public function statisticAction()
    {
        $projects = $this->getProjectRepository()->findBy(['isCompleted' => 1]);
        $institutions = $this->getInstitutionRepository()->findAll();
        $person = $persons = $this->getPersonRepository()->findAll();

        return $this->render('project/statistic.twig', ['projects' => $projects, 'institutions' => $institutions,
            'persons' => $person]);
    }

     /**
     * @Route("/{locale}/project/list", name="project_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {//* @Security("is_granted('ROLE_ADMIN')")
        $result = $this->getProjectRepository()->findBy(['isCompleted' => 1]);

        return $this->render('project/list.twig', ['result' => $result]);
    }

    /**
     * @Route("/{locale}/project/create", name="project_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $projectForm->handleRequest($request);

        $actionTab = $this->showActionTab($project);

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

            if ($actionTab) {
                return $this->redirectToRoute('action_create');
            }

            return $this->redirectToRoute('resources_create');
        }

        $data = [
            'my_form' => $projectForm->createView(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
            'actionTab' => $actionTab,
        ];

        return $this->render('project/create.twig', $data);
    }

    /**
     * @Route("/{locale}/project/create-project", name="project_create_start", requirements={"locale": "%app.locales%"})
     *
     */
    public function createProjectAction(Request $request)
    {
        $project = new Project();

        $projectForm = $this->createForm(ProjectStartForm::class, $project, [
            'action' => $this->generateUrl('project_create_start'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid())
        {
            $project->setUser($this->getUser());
            $this->getProjectRepository()->saveProject($project);


            if ($project->getKeyActions()->getName($request->getLocale()) == 'ka1') {
                return $this->redirectToRoute('project_create', ['active' => 'project']);
            } else {
                return $this->redirectToRoute('project_ka2_create', ['active' => 'project']);
            }

        }

        $data = [
            'my_form' => $projectForm->createView()
        ];

        return $this->render('project/project-create.twig', $data);
    }

    /**
     * @Route("/{locale}/project-ka2/create", name="project_ka2_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createKa2Action(Request $request)
    {
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectForm = $this->createForm(ProjectKa2Form::class, $project, [
            'action' => $this->generateUrl('project_ka2_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid())
        {
            $this->getProjectRepository()->saveProject($project);

            /** @var ProjectTargetGroup $targetGroup */
            foreach($project->getProjectTargetGroup() as $targetGroup){
                $targetGroup->setProject($project);
                $this->getProjectTargetGroupRepository()->save($targetGroup);
            }

            /** @var ProjectSubjectArea $subjectArea */
            foreach($project->getSubjectAreas() as $subjectArea){
                $subjectArea->setProject($project);
                $this->getProjectSubjectAreasRepository()->save($subjectArea);
            }

            /** @var ProjectPriority $priority */
            foreach($project->getProjectPriority() as $priority){
                $priority->setProject($project);
                $this->getProjectPriorityRepository()->save($priority);
            }

            /** @var ProjectContact $contact */
            foreach($project->getContacts() as $contact){
                $contact->setProject($project);
                $this->getContactsRepository()->save($contact);
            }

            return $this->redirectToRoute('deliverables_create');

        }

        $data = [
            'my_form' => $projectForm->createView(),
            'projectId' => $project->getId(),
            'isCompleted' => $project->getIsCompleted(),
        ];

        return $this->render('project/create-ka2.twig', $data);
    }

    /**
     * @Route("/{locale}/project/edit/{projectId}", name="project_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'isCompleted' => $project->getIsCompleted(),
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

            if (!$project->getIsCompleted()) {
                return $this->redirectToRoute('resources_create');
            }
        }

        return $this->render('project/edit.twig',
            [
                'my_form' => $projectForm->createView(),
                'projectId' => $projectId,
                'isCompleted' => $project->getIsCompleted(),
                'actionTab' => $this->showActionTab($project),
        ]);
    }

    /**
     * @Route("/{locale}/project-ka2/edit/{projectId}", name="project_ka2_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editKa2Action(Request $request, $projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectForm = $this->createForm(ProjectKa2Form::class, $project, [
            'action' => $this->generateUrl('project_ka2_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $originalTargetGroups = new ArrayCollection();
        $originalSubjectAreas = new ArrayCollection();
        $originalPriorities = new ArrayCollection();
        $originalContacts = new ArrayCollection();

        foreach ($project->getProjectTargetGroup() as $targetGroup) {
            $originalTargetGroups->add($targetGroup);
        }

        foreach ($project->getSubjectAreas() as $subjectArea){
            $originalSubjectAreas->add($subjectArea);
        }

        foreach ($project->getProjectPriority() as $priority){
            $originalPriorities->add($priority);
        }

        foreach ($project->getContacts() as $contact){
            $originalContacts->add($contact);
        }

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($originalTargetGroups as $targetGroup) {
                if (false === $project->getProjectTargetGroup()->contains($targetGroup)) {
                    $em->remove($targetGroup);
                }
            }

            /** @var ProjectTargetGroup $targetGroup */
            foreach ($project->getProjectTargetGroup() as $targetGroup) {
                if (false === $originalTargetGroups->contains($targetGroup)) {
                    $targetGroup->setProject($project);
                    $this->getProjectTargetGroupRepository()->save($targetGroup);
                }
            }

            foreach ($originalSubjectAreas as $subjectArea) {
                if (false === $project->getSubjectAreas()->contains($subjectArea)) {
                    $em->remove($subjectArea);
                }
            }

            /** @var ProjectSubjectArea $subjectAria */
            foreach ($project->getSubjectAreas() as $subjectAria) {
                if (false === $originalSubjectAreas->contains($subjectAria)) {
                    $subjectAria->setProject($project);
                    $this->getProjectSubjectAreasRepository()->save($subjectAria);
                }
            }

            foreach ($originalPriorities as $priority) {
                if (false === $project->getProjectPriority()->contains($priority)) {
                    $em->remove($priority);
                }
            }

            /** @var ProjectPriority $priority */
            foreach ($project->getProjectPriority() as $priority) {
                if (false === $originalPriorities->contains($priority)) {
                    $priority->setProject($project);
                    $this->getProjectPriorityRepository()->save($priority);
                }
            }

            foreach ($originalContacts as $contact) {
                if (false === $project->getContacts()->contains($contact)) {
                    $em->remove($contact);
                }
            }

            /** @var ProjectContact $contact */
            foreach ($project->getContacts() as $contact) {
                if (false === $originalContacts->contains($contact)) {
                    $contact->setProject($project);
                    $this->getContactsRepository()->save($contact);
                }
            }

            $this->getProjectRepository()->saveProject($project);

            if (!$project->getIsCompleted()) {
                return $this->redirectToRoute('monitoring_create');
            }

        }

        return $this->render('project/edit-ka2.twig',
            [
                'my_form' => $projectForm->createView(),
                'id' => $projectId,
                'isCompleted' => $project->getIsCompleted(),
            ]
        );
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

        return $this->render('project/view.twig', ['project' => $project, 'projectId' => $projectId, 'actionTab' => $this->showActionTab($project)]);
    }

    /**
     * @Route("/{locale}/project-ka2/{projectId}", name="project_ka2_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     * }
     */
    public function viewProjectKa2Action($projectId)
    {
        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (!$project) {
            throw $this->createNotFoundException(
                'No project found for id '. $projectId
            );
        }

        $originalTargetGroups = new ArrayCollection();
        $originalSubjectAreas = new ArrayCollection();
        $originalPriorities = new ArrayCollection();
        $originalContacts = new ArrayCollection();

        foreach ($project->getProjectTargetGroup() as $targetGroup) {
            $originalTargetGroups->add($targetGroup);
        }

        foreach ($project->getSubjectAreas() as $subjectArea){
            $originalSubjectAreas->add($subjectArea);
        }

        foreach ($project->getProjectPriority() as $priority){
            $originalPriorities->add($priority);
        }

        foreach ($project->getContacts() as $contact){
            $originalContacts->add($contact);
        }

        return $this->render('project/view-ka2.twig', ['project' => $project, 'projectId' => $projectId]);
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

    /**
     * @return ProjectTargetGroupRepository
     */
    private function getProjectTargetGroupRepository() {

        return $this->get('doctrine_entity_repository.project_target_group');
    }

    /**
     * @return ProjectTargetGroupFewerOpportunitiesRepository
     */

    private function getProjectTargetGroupFewerOpportunitiesRepository() {

        return $this->get('doctrine_entity_repository.project_target_group');
    }

    /**
     * @return ProjectNoteRepository
     */
    private function getProjectPriorityRepository() {

        return $this->get('doctrine_entity_repository.project_priority');
    }

    /**
     * @return ProjectContactRepository
     */
    private function getContactsRepository() {

        return $this->get('doctrine_entity_repository.project_contact');
    }

    /**
     * @return ProjectEvaluatorGradeRepository
     */
    private function getProjectEvaluatorGradeRepository() {

        return $this->get('doctrine_entity_repository.project_evaluator_grade');
    }

    /**
     * @return InstitutionRepository
     */
    private function getInstitutionRepository() {

        return $this->get('doctrine_entity_repository.institution');
    }

    /**
     * @return PersonRepository
     */
    private function getPersonRepository() {

        return $this->get('doctrine_entity_repository.person');
    }
}