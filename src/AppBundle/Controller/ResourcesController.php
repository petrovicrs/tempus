<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 12:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Resources;
use AppBundle\Form\ResourcesForm;
use AppBundle\Repository\ResourcesRepository;
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

        $resourcesForm = $this->createForm(ResourcesForm::class, $resources, [
            'action' => $this->generateUrl('resources_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resourcesForm->handleRequest($request);

        if ($resourcesForm->isSubmitted() && $resourcesForm->isValid()) {
            $resources->setProject($this->getLastProjectForCurrentUser());
            $this->getResourcesRepository()->save($resources);

            return $this->redirectToRoute('resources_list');
        }

        return $this->render('resources/create.twig', ['my_form' => $resourcesForm->createView()]);
    }

    /**
     * @Route("/{locale}/resources/edit/{resourceId}", name="resource_edit", requirements={"resourceId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $resourceId)
    {
        $resource = $this->getResourcesRepository()->findOneBy(['id' => $resourceId]);

        $resourceForm = $this->createForm(ResourcesForm::class, $resource, [
            'action' => $this->generateUrl('resource_edit', ['resourceId' => $resourceId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $resourceForm->handleRequest($request);

        if ($resourceForm->isSubmitted() && $resourceForm->isValid()) {

            $this->getResourcesRepository()->save($resource);

            return $this->redirectToRoute('resources_list');
        }

        return $this->render('resources/edit.twig', ['my_form' => $resourceForm->createView()]);
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
}