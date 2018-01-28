<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 09.08.17
 * Time: 22:32
 */

namespace AppBundle\Controller;

use AppBundle\Entity\IntelectualOutputs;
use AppBundle\Entity\ProjectIntelectualOutputs;
use AppBundle\Form\IntelectualOutputsForm;
use AppBundle\Form\ProjectIntelectualOutputsForm;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Project;
use AppBundle\Repository\ProjectRepository;

class IntelectualOutputsController extends AbstractController
{
    /**
     * @Route("/{locale}/intelectual-outputs/list", name="intelectual_outputs_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $intelectualOutputs = $this->getIntelectualOutputsRepository()->findAll();

        return $this->render('intelectual-outputs/list.twig', ['intelectualOutputs' => $intelectualOutputs]);
    }

    /**
     * @Route("/{locale}/intelectual-outputs/create", name="intelectual_outputs_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectIntelectualOutputs = new ProjectIntelectualOutputs();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectIntelectualOutputsForm = $this->createForm(ProjectIntelectualOutputsForm::class, $projectIntelectualOutputs, [
            'action' => $this->generateUrl('intelectual_outputs_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectIntelectualOutputsForm->handleRequest($request);

        if ($projectIntelectualOutputsForm->isSubmitted() && $projectIntelectualOutputsForm->isValid()) {

            foreach ($projectIntelectualOutputs->getIntelectualOutputs() as $intelectualOutput) {
                $intelectualOutput->setProjectIntelectualOutputs($projectIntelectualOutputs);
            }

            $projectIntelectualOutputs->setProject($project);
            $this->getProjectIntelectualOutputsRepository()->save($projectIntelectualOutputs);

            return $this->redirectToRoute('results_create');
        }

        return $this->render('intelectual-outputs/create.twig', ['my_form' => $projectIntelectualOutputsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()
        ]);
    }

    /**
     * @Route("/{locale}/intelectual-outputs/edit/{projectId}", name="intelectual_output_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectIntelectualOutputs[] $projectIntelectualOutput */
        $projectIntelectualOutput = $this->getProjectIntelectualOutputsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (count($projectIntelectualOutput) === 0) {
            $projectIntelectualOutput = new ProjectIntelectualOutputs();
            $projectIntelectualOutput->setProject($project);
            $this->getProjectIntelectualOutputsRepository()->save($projectIntelectualOutput);
        }

        $projectIntelectualOutputForm = $this->createForm(ProjectIntelectualOutputsForm::class, $projectIntelectualOutput, [
            'action' => $this->generateUrl('intelectual_output_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $originalIntelectualOutputs = new ArrayCollection();

        if (count($projectIntelectualOutput) > 0) {
            foreach ($projectIntelectualOutput->getIntelectualOutputs() as $output) {
                $originalIntelectualOutputs->add($output);
            }
        }


        $projectIntelectualOutputForm->handleRequest($request);

        if ($projectIntelectualOutputForm->isSubmitted() && $projectIntelectualOutputForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var IntelectualOutputs $intelectualOutput */
            foreach ($originalIntelectualOutputs as $intelectualOutput) {
                if (false === $projectIntelectualOutput->getIntelectualOutputs()->contains($intelectualOutput)) {
                    $em->remove($intelectualOutput);
                }
            }

            /** @var IntelectualOutputs $intelectualOutput */
            foreach ($projectIntelectualOutput->getIntelectualOutputs() as $intelectualOutput) {
                if (false === $originalIntelectualOutputs->contains($intelectualOutput)) {
                    $intelectualOutput->setProjectIntelectualOutputs($projectIntelectualOutput);
                    $this->getIntelectualOutputsRepository()->save($intelectualOutput);
                }
            }



            $this->getProjectIntelectualOutputsRepository()->save($projectIntelectualOutput);

            if (!$projectIntelectualOutput->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('results_create');
            }
        }

        return $this->render('intelectual-outputs/edit.twig',
            [
                'my_form' => $projectIntelectualOutputForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'isCompleted' => $project->getIsCompleted(),
            ]
        );
    }

    /**
     * @Route("/{locale}/intelectual-outputs/view/{projectId}", name="intelectual_output_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        /** @var ProjectIntelectualOutputs $projectIntelectualOutputs */
        $projectIntelectualOutputs = $this->getProjectIntelectualOutputsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        return $this->render(
            'intelectual-outputs/view.twig',
            [
                'intelectualOutputs' => $projectIntelectualOutputs ? $projectIntelectualOutputs->getIntelectualOutputs() : null,
                'projectId' => $projectId,
                'keyAction' => $project->getKeyActions()->getNameSr()
            ]
        );
    }

    private function getProjectIntelectualOutputsRepository()
    {
        return $this->get('doctrine_entity_repository.project_intelectual_outputs');
    }

    private function getIntelectualOutputsRepository()
    {
        return $this->get('doctrine_entity_repository.intelectual_outputs');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}