<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 17:35
 */

namespace AppBundle\Controller;


use AppBundle\Entity\MonitoringReporting;
use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectMonitoringReporting;
use AppBundle\Form\MonitoringReportingForm;
use AppBundle\Form\ProjectMonitoringReportingForm;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MonitoringReportingController extends AbstractController
{
    /**
     * @Route("/{locale}/monitoring/list", name="monitoring_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $all = $this->getMonitoringReportingRepository()->findAll();
        return $this->render('monitoring-reporting/list.twig', ['monitoring' => $all]);
    }

    /**
     * @Route("/{locale}/monitoring/create", name="monitoring_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectMonitoringReporting = new ProjectMonitoringReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectMonitoringForm = $this->createForm(ProjectMonitoringReportingForm::class, $projectMonitoringReporting, [
            'action' => $this->generateUrl('monitoring_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectMonitoringForm->handleRequest($request);

        if ($projectMonitoringForm->isSubmitted() && $projectMonitoringForm->isValid()) {

            $projectMonitoringReporting->setProject($this->getLastProjectForCurrentUser());

            /** @var MonitoringReporting $one */
            foreach($projectMonitoringReporting->getMonitoringReporting() as $one) {
                $one->setProjectMonitoringReporting($projectMonitoringReporting);
            }

            $this->getProjectMonitoringReportingRepository()->save($projectMonitoringReporting);

            return $this->redirectToRoute('partner_create');
        }

        return $this->render(
            'monitoring-reporting/create.twig',
            [
                'my_form' => $projectMonitoringForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
            ]
        );
    }

    /**
     * @Route("/{locale}/monitoring/edit/{projectId}", name="monitoring_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectMonitoringReporting $projectMonitoringReporting */
        $projectMonitoringReporting = $this->getProjectMonitoringReportingRepository()->findOneBy(['project' => $projectId]);

        $projectMonitoringForm = $this->createForm(ProjectMonitoringReportingForm::class, $projectMonitoringReporting, [
            'action' => $this->generateUrl('monitoring_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $projectMonitoringReporting->getProject()->getIsCompleted(),
        ]);

        $originalMonitoringReporting = new ArrayCollection();

        foreach ($projectMonitoringReporting->getMonitoringReporting() as $monitoring) {
            $originalMonitoringReporting->add($monitoring);
        }

        $projectMonitoringForm->handleRequest($request);

        if ($projectMonitoringForm->isSubmitted() && $projectMonitoringForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($originalMonitoringReporting as $monitoring) {
                if (false === $projectMonitoringReporting->getMonitoringReporting()->contains($monitoring)) {
                    $em->remove($monitoring);
                }
            }

            /** @var MonitoringReporting $monitoringReporting */
            foreach ($projectMonitoringReporting->getMonitoringReporting() as $monitoringReporting) {
                if (false === $originalMonitoringReporting->contains($monitoringReporting)) {
                    $monitoringReporting->setProjectMonitoringReporting($projectMonitoringReporting);
                    $this->getMonitoringReportingRepository()->save($monitoringReporting);
                }
            }

            $this->getProjectMonitoringReportingRepository()->save($projectMonitoringReporting);

            if (!$projectMonitoringReporting->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('partner_create');
            }
        }

        return $this->render(
            'monitoring-reporting/edit.twig',
            [
                'my_form' => $projectMonitoringForm->createView(),
                'keyAction' => $projectMonitoringReporting->getProject()->getKeyActions()->getNameSr(),
                'projectId' => $projectId,
                'isCompleted' => $projectMonitoringReporting->getProject()->getIsCompleted(),
            ]
        );
    }

    /**
     * @Route("/{locale}/monitoring/view/{id}", name="monitoring_view", requirements={"locale": "%app.locales%", "id": "\d+"})
     */
    public function viewAction($id)
    {
        $monitoring = $this->getMonitoringReportingRepository()->findOneBy(['id' => $id]);

        return $this->render('monitoring-reporting/view.twig', ['monitoring' => $monitoring, 'id' => $id]);
    }

    private function getProjectMonitoringReportingRepository()
    {
        return $this->get('doctrine_entity_repository.project_monitoring_reporting');
    }

    private function getMonitoringReportingRepository()
    {
        return $this->get('doctrine_entity_repository.monitoring_reporting');
    }
}