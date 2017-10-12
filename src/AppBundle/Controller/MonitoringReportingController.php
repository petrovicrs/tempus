<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 17:35
 */

namespace AppBundle\Controller;


use AppBundle\Entity\MonitoringReporting;
use AppBundle\Entity\ProjectMonitoringReporting;
use AppBundle\Form\MonitoringReportingForm;
use AppBundle\Form\ProjectMonitoringReportingForm;
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
            ['my_form' => $projectMonitoringForm->createView(), 'keyAction' => $project->getKeyActions()->getNameSr()]);
    }

    /**
     * @Route("/{locale}/monitoring/edit/{id}", name="monitoring_edit", requirements={"locale": "%app.locales%", "id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $monitoringReporting = $this->getMonitoringReportingRepository()->findOneBy(['id' => $id]);

        $monitoringForm = $this->createForm(MonitoringReportingForm::class, $monitoringReporting, [
            'action' => $this->generateUrl('monitoring_edit', ['id' => $id]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $monitoringForm->handleRequest($request);

        if ($monitoringForm->isSubmitted() && $monitoringForm->isValid()) {

            $monitoringReporting->setProject($this->getLastProjectForCurrentUser());
            $this->getMonitoringReportingRepository()->save($monitoringReporting);

            return $this->redirectToRoute('partner_edit', ['id' => $id]);
        }

        return $this->render(
            'monitoring-reporting/edit.twig',
            ['my_form' => $monitoringForm->createView(), 'id' => $id]);
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