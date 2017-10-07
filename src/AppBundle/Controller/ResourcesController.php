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

class ResourcesController extends AbstractController
{
    /**
     * @Route("/{locale}/resources/list", name="resources_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $resources = $this->getResourcesRepository()->findAll();

        return $this->render('resources/list.twig', ['resources' => $resources]);
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
            'locale' => $request->getLocale()
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
            'locale' => $request->getLocale()
        ]);

        $projectResourceForm->handleRequest($request);

        if ($projectResourceForm->isSubmitted() && $projectResourceForm->isValid()) {

            foreach ($projectResources->getResources() as $resource) {
                $this->getResourcesRepository()->save($resource);

            }

            if (!$projectResources->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('intelectual_outputs_create');
            }
        }

        return $this->render('resources/edit.twig', ['my_form' => $projectResourceForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr()]);
    }

    /**
     * @Route("/{locale}/resources/view/{resourceId}", name="resource_view", requirements={"resourceId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($resourceId)
    {
        $resource = $this->getResourcesRepository()->findOneBy(['id' => $resourceId]);

        return $this->render('resources/view.twig', ['resource' => $resource]);
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