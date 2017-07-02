<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use PhpOption\Tests\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\ProjectForm;
use AppBundle\Entity\Projects;
use AppBundle\Repository\ProjectsRepository;

use Symfony\Component\HttpFoundation\Request;

class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="default_route")
     * @Route("/{locale}/project/list", name="project_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $result = $this->getProjectsRepository()->findAll();

        return $this->render('project/list.twig', ['result' => $result]);
    }

    /**
     * @Route("/{locale}/project/create", name="project_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $project = new Projects();

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST'
            ]);


        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid())
        {
            $this->getProjectsRepository()->saveProject($project);

            return $this->redirectToRoute('project_list');

        }

        return $this->render('project/create.twig', ['my_form' => $projectForm->createView()]);
    }

    /**
     * @Route("/{locale}/project/edit/{projectId}", name="project_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        $project = $this->getProjectsRepository()->findOneBy(['id' => $projectId]);

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'submit_button_label' => 'Save'
        ]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $this->getProjectsRepository()->saveProject($project);

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/edit.twig', ['my_form' => $projectForm->createView()]);
    }

    /**
     * @Route("/{locale}/project/{projectId}", name="project_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     * }
     */
    public function viewProjectAction(Request $request, $projectId)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $this->getProjectsRepository()->find($projectId);

        if (!$project) {
            throw $this->createNotFoundException(
                'No project found for id '. $projectId
            );
        }

        return $this->render('project/view.twig', ['project' => $project]);
    }

    /**
     * @return ProjectsRepository
     */
    private function getProjectsRepository() {

        return $this->get('doctrine_entity_repository.projects');
    }

}