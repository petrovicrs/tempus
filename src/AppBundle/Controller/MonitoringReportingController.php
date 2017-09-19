<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 17:35
 */

namespace AppBundle\Controller;


use AppBundle\Entity\MonitoringReporting;
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
            ['my_form' => $monitoringForm->createView(), 'keyAction' => $project->getKeyActions()->getNameSr()]);
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

            return $this->redirectToRoute('monitoring_list');
        }

        return $this->render(
            'monitoring-reporting/edit.twig',
            ['my_form' => $monitoringForm->createView()]);
    }

    /**
     * @Route("/{locale}/monitoring/view/{id}", name="monitoring_view", requirements={"locale": "%app.locales%", "id": "\d+"})
     */
    public function viewAction($id)
    {
        $monitoring = $this->getMonitoringReportingRepository()->findOneBy(['id' => $id]);

        return $this->render('monitoring-reporting/view.twig', ['monitoring' => $monitoring]);
    }

    private function getMonitoringReportingRepository()
    {
        return $this->get('doctrine_entity_repository.monitoring_reporting');
    }
}