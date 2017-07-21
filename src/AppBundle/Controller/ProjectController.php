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
use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            ]);


        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid())
        {
            $this->getProjectRepository()->saveProject($project);

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
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'submit_button_label' => 'Save'
        ]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $this->getProjectRepository()->saveProject($project);

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/edit.twig', ['my_form' => $projectForm->createView()]);
    }

    /**
     * @Route("/{locale}/project/{projectId}", name="project_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     * }
     */
    public function viewProjectAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $this->getProjectRepository()->find($projectId);

        if (!$project) {
            throw $this->createNotFoundException(
                'No project found for id '. $projectId
            );
        }

        return $this->render('project/view.twig', ['project' => $project]);
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }

}