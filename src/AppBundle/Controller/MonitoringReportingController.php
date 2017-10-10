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
use AppBundle\Form\MonitoringReportingForm;
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
        $monitoringReporting = new MonitoringReporting();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $monitoringForm = $this->createForm(MonitoringReportingForm::class, $monitoringReporting, [
            'action' => $this->generateUrl('monitoring_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $monitoringForm->handleRequest($request);

        if ($monitoringForm->isSubmitted() && $monitoringForm->isValid()) {

            $monitoringReporting->setProject($this->getLastProjectForCurrentUser());
            $this->getMonitoringReportingRepository()->save($monitoringReporting);

            return $this->redirectToRoute('partner_create');
        }

        return $this->render(
            'monitoring-reporting/create.twig',
            [
                'my_form' => $monitoringForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
            ]);
    }

    /**
     * @Route("/{locale}/monitoring/edit/{projectId}", name="monitoring_edit", requirements={"locale": "%app.locales%", "projectId": "\d+"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var MonitoringReporting $monitoringReporting */
        $monitoringReporting = $this->getMonitoringReportingRepository()->findOneBy(['project' => $projectId]);


        $monitoringForm = $this->createForm(MonitoringReportingForm::class, $monitoringReporting, [
            'action' => $this->generateUrl('monitoring_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $monitoringReporting->getProject()->getIsCompleted(),
        ]);

        $monitoringForm->handleRequest($request);

        if ($monitoringForm->isSubmitted() && $monitoringForm->isValid()) {

            $monitoringReporting->setProject($this->getLastProjectForCurrentUser());
            $this->getMonitoringReportingRepository()->save($monitoringReporting);

            if (!$monitoringReporting->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('monitoring_create');
            }
        }

        return $this->render(
            'monitoring-reporting/edit.twig',
            [
                'my_form' => $monitoringForm->createView(),
                'projectId' => $projectId
            ]);
    }

    /**
     * @Route("/{locale}/monitoring/view/{id}", name="monitoring_view", requirements={"locale": "%app.locales%", "id": "\d+"})
     */
    public function viewAction($id)
    {
        $monitoring = $this->getMonitoringReportingRepository()->findOneBy(['id' => $id]);

        return $this->render('monitoring-reporting/view.twig', ['monitoring' => $monitoring, 'id' => $id]);
    }

    private function getMonitoringReportingRepository()
    {
        return $this->get('doctrine_entity_repository.monitoring_reporting');
    }
}