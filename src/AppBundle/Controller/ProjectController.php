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
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\ProjectForm;
use AppBundle\Entity\Projects;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProjectController extends Controller
{
    /**
     *{ @Route("project/list"), name="project_list")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository('AppBundle:Projects')->findAll();

        $response = $this->render('project/list.twig', ['result' => $result]);

        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    /**
     *{ @Route("/project/create"), name="project_create" }
     *
     */
    public function createAction(Request $request)
    {
        $project = new Projects();
        $projectForm = $this->createForm(ProjectForm::class, $project);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $response = $this->render(
                'project/list.twig',
                [
                    'result' => $em->getRepository('AppBundle:Projects')->findAll(),
                ]
            );

            $response->headers->set('Content-Type', 'text/html');

            return $response;
        } else {
            $form = $this->createForm(ProjectForm::class, null, [
                'action' => $this->generateUrl('project_create'),
                'method' => 'POST'
            ]);

            $form->add('submit', SubmitType::class, array(
                'label' => 'Create',
                'attr'  => array('class' => 'btn btn-default pull-right')
            ));
        }
        $response = $this->render(
            'project/create.twig',
            [
                'form' => $form->createView(),
            ]
        );

        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    /**
     *{ @Route("/project/edit/{projectId}"), name="project_edit", requirements={"projectId": "\d+"} }
     *
     */
    public function editAction($projectId)
    {
        $project = new Projects();
        $projectForm = $this->createForm(ProjectForm::class, $project);

        $projectForm->handleRequest($request);

        if ($projectForm->isSubmitted() && $projectForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();

            $response = $this->render(
                'project/list.twig',
                [
                    'result' => $em->getRepository('AppBundle:Projects')->findAll(),
                ]
            );

            $response->headers->set('Content-Type', 'text/html');

            return $response;
        } else {
            $form = $this->createForm(ProjectForm::class, null, [
                'action' => $this->generateUrl('project_create'),
                'method' => 'POST'
            ]);

            $form->add('submit', SubmitType::class, array(
                'label' => 'Create',
                'attr'  => array('class' => 'btn btn-default pull-right')
            ));
        }
        $response = $this->render(
            'project/create.twig',
            [
                'form' => $form->createView(),
            ]
        );

        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

    /**
     * { @Route("/project/view/{projectId}"), name="project_view", requirements={"projectId": "\d+"} }
     */
    public function viewProjectAction($projectId)
    {
        $em = $this->getDoctrine()->getManager();

        $result = $em->getRepository('AppBundle:Projects')->find($projectId);

        if (!$result) {
            throw $this->createNotFoundException(
                'No project found for id '. $projectId
            );
        }

        $response = $this->render('project/view.twig', ['result' => $result]);

        $response->headers->set('Content-Type', 'text/html');

        return $response;
    }

}