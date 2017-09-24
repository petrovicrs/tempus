<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 12:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Resources;
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
        $resources = new Resources();
        
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $resourcesForm = $this->createForm(ResourcesForm::class, $resources, [
            'action' => $this->generateUrl('resources_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resourcesForm->handleRequest($request);

        if ($resourcesForm->isSubmitted() && $resourcesForm->isValid()) {
            
            $resources->setProject($project);
            $this->getResourcesRepository()->save($resources);

            return $this->redirectToRoute('intelectual_outputs_create');
        }

        return $this->render('resources/create.twig', ['my_form' => $resourcesForm->createView(), 
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/resources/edit/{projectId}", name="resource_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Resources $resource */
        $resource = $this->getResourcesRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $resourceForm = $this->createForm(ResourcesForm::class, $resource, [
            'action' => $this->generateUrl('resource_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resourceForm->handleRequest($request);

        if ($resourceForm->isSubmitted() && $resourceForm->isValid()) {

            $this->getResourcesRepository()->save($resource);

            if (!$resource->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('intelectual_outputs_create');
            }
        }

        return $this->render('resources/edit.twig', ['my_form' => $resourceForm->createView(),
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