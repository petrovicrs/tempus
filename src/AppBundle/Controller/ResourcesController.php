<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 12:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectResources;
use AppBundle\Entity\Resources;
use AppBundle\Form\ProjectResourcesForm;
use AppBundle\Form\ResourcesForm;
use AppBundle\Repository\ResourcesRepository;
use AppBundle\Repository\ProjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class ResourcesController extends AbstractController
{
    /**
     * @Route("/{locale}/resources/list", name="resources_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $projectResources = $this->getProjectResourcesRepository()->findAll();
        return $this->render('resources/list.twig', ['projectResources' => $projectResources]);
    }

    /**
     * @Route("/{locale}/resources/create", name="resources_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectResources = new ProjectResources();
        
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectResourcesForm = $this->createForm(ProjectResourcesForm::class, $projectResources, [
            'action' => $this->generateUrl('resources_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $projectResourcesForm->handleRequest($request);

        if ($projectResourcesForm->isSubmitted() && $projectResourcesForm->isValid()) {

            $projectResources->setProject($project);

            /** @var Resources $resource */
            foreach ($projectResources->getResources() as $resource) {
                $resource->setProjectResources($projectResources);
            }

            $this->getProjectResourcesRepository()->save($projectResources);

            return $this->redirectToRoute('intelectual_outputs_create');
        }

        return $this->render('resources/create.twig', ['my_form' => $projectResourcesForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/resources/edit/{projectId}", name="resource_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectResources $projectResources */
        $projectResources = $this->getProjectResourcesRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectResourceForm = $this->createForm(ProjectResourcesForm::class, $projectResources, [
            'action' => $this->generateUrl('resource_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $originalResources = new ArrayCollection();

        if ($projectResources) {
            /** @var Resources $resource */
            foreach ($projectResources->getResources() as $resource) {
                $originalResources->add($resource);
            }
        }

        $projectResourceForm->handleRequest($request);

        if ($projectResourceForm->isSubmitted() && $projectResourceForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            if (count($originalResources)) {
                /** @var Resources $originalResource */
                foreach ($originalResources as $originalResource) {
                    if (false === $projectResources->getResources()->contains($originalResource)) {
                        $em->remove($originalResource);
                    }
                }
            }

            /** @var Resources $resource */
            foreach ($projectResources->getResources() as $resource) {
                if (false === $originalResources->contains($resource)) {
                    $resource->setProjectResources($projectResources);
                    $this->getProjectResourcesRepository()->save($resource);
                }
            }

            $this->getResourcesRepository()->save($projectResources);

            if (!$project->getIsCompleted()) {
                return $this->redirectToRoute('intelectual_outputs_create');
            }
        }

        return $this->render('resources/edit.twig',
            [
                'my_form' => $projectResourceForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'isCompleted' => $project->getIsCompleted(),
            ]);
    }

    /**
     * @Route("/{locale}/resources/view/{projectId}", name="resource_view", requirements={"$projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        $projectResources = $this->getProjectResourcesRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        return $this->render('resources/view.twig', [
            'projectResources' => $projectResources,
            'projectId' => $projectId,
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'project' => $project,
        ]);
    }

    private function getProjectResourcesRepository()
    {
        return $this->get('doctrine_entity_repository.project_resources');
    }

    private function getResourcesRepository()
    {
        return $this->get('doctrine_entity_repository.resources');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}