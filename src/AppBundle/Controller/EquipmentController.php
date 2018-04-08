<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 08.08.17
 * Time: 22:27
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Equipment;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectEquipment;
use AppBundle\Entity\ProjectResults;
use AppBundle\Entity\Results;
use AppBundle\Form\ProjectEquipmentForm;
use AppBundle\Form\ProjectResultsForm;
use AppBundle\Repository\EquipmentRepository;
use AppBundle\Repository\ProjectEquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\ProjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EquipmentController extends AbstractController
{
    /**
     * @Route("/{locale}/equipment/list", name="equipment_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $equipment = $this->getEquipmentRepository()->findAll();

        return $this->render('equipment/list.twig', ['equipment' => $equipment]);
    }

    /**
     * @Route("/{locale}/equipment/create", name="equipment_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        /** @var ProjectEquipment $projectEquipment */
        $projectEquipment = new ProjectEquipment();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectEquipmentForm = $this->createForm(ProjectEquipmentForm::class, $projectEquipment, [
            'action' => $this->generateUrl('equipment_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectEquipmentForm->handleRequest($request);

        if ($projectEquipmentForm->isSubmitted() && $projectEquipmentForm->isValid()) {
            /** @var Equipment $equipment */
            foreach($projectEquipment->getEquipment() as $equipment) {
                $equipment->setProjectEquipment($projectEquipment);
            }
            $projectEquipment->setProject($project);
            $this->getProjectEquipmentRepository()->save($projectEquipment);

            return $this->redirectToRoute('attachments_create');
        }

        return $this->render('equipment/create.twig', ['my_form' => $projectEquipmentForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/equipment/edit/{projectId}", name="equipment_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectEquipment $projectEquipment */
        $projectEquipment = $this->getProjectEquipmentRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (count($projectEquipment) === 0) {
            $projectEquipment = new ProjectEquipment();
            $projectEquipment->setProject($project);
            $this->getProjectEquipmentRepository()->save($projectEquipment);
        }

        $projectEquipmentForm = $this->createForm(ProjectEquipmentForm::class, $projectEquipment, [
            'action' => $this->generateUrl('equipment_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $originalEquipment = new ArrayCollection();

        /** @var Equipment $equipment */
        foreach ($projectEquipment->getEquipment() as $equipment) {
            $originalEquipment->add($equipment);
        }

        $projectEquipmentForm->handleRequest($request);

        if ($projectEquipmentForm->isSubmitted() && $projectEquipmentForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var Equipment $one */
            foreach ($originalEquipment as $one) {
                if (false === $projectEquipment->getEquipment()->contains($one)) {
                    $em->remove($one);
                }
            }

            /** @var Equipment $equipment */
            foreach ($projectEquipment->getEquipment() as $equipment) {
                if (false === $originalEquipment->contains($equipment)) {
                    $equipment->setProjectEquipment($projectEquipment);
                    $this->getEquipmentRepository()->save($equipment);
                }
            }

            $this->getProjectEquipmentRepository()->save($projectEquipment);

            if (!$projectEquipment->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('attachments_create');
            }
        }

        return $this->render('equipment/edit.twig',
            [
                'my_form' => $projectEquipmentForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'isCompleted' => $project->getIsCompleted(),
            ]
        );
    }

    /**
     * @Route("/{locale}/equipment/view/{projectId}", name="equipment_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        /** @var ProjectEquipment $projectEquipment */
        $projectEquipment = $this->getProjectEquipmentRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        return $this->render(
            'equipment/view.twig',
            [
                'equipment' => $this->getEquipmentRepository()->findBy(['projectEquipment' => $projectEquipment]),
                'projectId' => $projectId,
                'keyAction' => $project->getKeyActions()->getNameSr()
            ]
        );
    }

    /**
     * @return ProjectEquipmentRepository
     */
    private function getProjectEquipmentRepository()
    {
        return $this->get('doctrine_entity_repository.project_equipment');
    }

    /**
     * @return EquipmentRepository
     */
    private function getEquipmentRepository()
    {
        return $this->get('doctrine_entity_repository.equipment');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}