<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\ProjectForm;
use AppBundle\Entity\Projects;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProjectController extends Controller
{
    /**
     * @Route("project/list", name="project_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository('AppBundle:Projects')->findAll();

        return $this->render('project/list.twig', ['result' => $result]);
    }

    /**
     * @Route("/project/create", name="project_create")
     *
     */
    public function createAction(Request $request)
    {
        $project = new Projects();

        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST',
            ]);


        $projectForm->handleRequest($request);


//
//        $errors=$projectForm->getErrors(true);
//        var_dump(count($errors));
//        foreach($errors as $error){
//            var_dump($error->getMessage());
//        }
//        die;

        if ($projectForm->isSubmitted() && $projectForm->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_list');

        }

        return $this->render('project/create.twig', ['my_form' => $projectForm->createView()]);
    }

    /**
     * @Route("/project/edit/{projectId}", name="project_edit", requirements={"projectId": "\d+"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        $em = $this->getDoctrine()->getManager();
        $project = $em->getRepository('AppBundle:Projects')->findOneBy(['id' => $projectId]);
        $projectForm = $this->createForm(ProjectForm::class, $project, [
            'action' => $this->generateUrl('project_edit', ['projectId' => $projectId]),
            'method' => 'POST'
        ]);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/edit.twig', ['my_form' => $projectForm->createView()]);
    }

    /**
     * @Route("/project/{projectId}", name="project_view", requirements={"projectId": "\d+"})
     *
     * }
     */
    public function viewProjectAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('AppBundle:Projects')->find($projectId);

        if (!$project) {
            throw $this->createNotFoundException(
                'No project found for id '. $projectId
            );
        }

        return $this->render('project/view.twig', ['project' => $project]);
    }

}