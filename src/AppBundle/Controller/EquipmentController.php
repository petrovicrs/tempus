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
use AppBundle\Entity\ProjectResults;
use AppBundle\Entity\Results;
use AppBundle\Form\EquipmentForm;
use AppBundle\Form\EquipmentsForm;
use AppBundle\Form\ProjectResultsForm;
use AppBundle\Repository\EquipmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\Form;
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
        /** @var Equipment $equipment */
        $equipment = new Equipment();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $equipmentForm = $this->createForm(EquipmentsForm::class, ['equipment' => []], [
            'action' => $this->generateUrl('equipment_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $equipmentForm->handleRequest($request);

        if ($equipmentForm->isSubmitted() && $equipmentForm->isValid()) {

            foreach($equipmentForm as $equipmentFormEntry) {
                if ($equipmentFormEntry instanceof Form) {
                    /** @var Equipment $oneElement */
                    foreach ($equipmentFormEntry->getData() as $oneElement) {
                        $oneElement->setProject($project);

                        $this->getEquipmentRepository()->save($oneElement);
                    }
                }
            }

            return $this->redirectToRoute('attachments_create');
        }

        return $this->render('equipment/create.twig', ['my_form' => $equipmentForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId()]);
    }

    /**
     * @Route("/{locale}/equipment/edit/{projectId}", name="equipment_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var array[Equipment] $originalEquipments */
        $originalEquipments = $this->getEquipmentRepository()->findBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);


        $equipmentsForm = $this->createForm(EquipmentsForm::class, ['equipment' => $originalEquipments], [
            'action' => $this->generateUrl('equipment_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);


        $equipmentsForm->handleRequest($request);

        if ($equipmentsForm->isSubmitted() && $equipmentsForm->isValid()) {

            $newEquipment = [];
            foreach ($equipmentsForm as $equipmentFormEntry) {
                if($equipmentFormEntry instanceof Form){
                    $newEquipment = $equipmentFormEntry->getData();
                }
            }

            $em = $this->getDoctrine()->getManager();

            /** @var Equipment $one */
            foreach ($originalEquipments as $one) {

                if (!in_array($one, $newEquipment)) {
                    $em->remove($one);
                }
                $this->getEquipmentRepository()->save($one);
            }

            /** @var Equipment $equipment */
            foreach ($newEquipment as $equipment) {
                if (!in_array($equipment, $originalEquipments)) {
                    $equipment->setProject($project);
                    $this->getEquipmentRepository()->save($equipment);
                }
            }

            if (!$project->getIsCompleted()) {
                return $this->redirectToRoute('attachments_create');
            }
        }

        return $this->render('equipment/edit.twig',
            [
                'my_form' => $equipmentsForm->createView(),
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
        /** @var array[Equipment] $originalEquipments */
        $originalEquipments = $this->getEquipmentRepository()->findBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        return $this->render(
            'equipment/view.twig',
            [
                'equipment' => $originalEquipments,
                'projectId' => $projectId,
                'keyAction' => $project->getKeyActions()->getNameSr()
            ]
        );
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