<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;


use AppBundle\Entity\Project;
use AppBundle\Entity\Reporting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


abstract class AbstractController extends Controller {

    protected function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        if(!isset($parameters['locale'])){
            $parameters['locale'] = $this->get('translator')->getLocale();
        }
        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }


    protected function redirectToRoute($route, array $parameters = array(), $status = 302)
    {
        if(!isset($parameters['locale'])){
            $parameters['locale'] = $this->get('translator')->getLocale();
        }
        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    /**
     * @return Project
     */
    protected function getLastProjectForCurrentUser()
    {
        $user = $this->getUser();
        /** @var Project $lastProject */
        $lastProject = $this->get('doctrine_entity_repository.project')
            ->findOneBy(
                ['user' => $user],
                ['id' => 'DESC']
            );

        return $lastProject;
    }

    /**
     * @param Project $project
     * @return bool
     */
    protected function showActionTab(Project $project)
    {
        $action = $project->getActions()->getNameSr();

        if ($action == 'KA101' || $action == 'KA102' || $action == 'KA103' || $action == 'KA104' || $action == 'KA105'
            || $action == 'KA106' || $action == 'KA107' || $action == 'KA125') {
            return true;
        }

        return false;
    }

    /**
     * @param $project
     * @return Reporting
     */
    protected function getLastReportForCurrentUserByProject($project): Reporting
    {
        $user = $this->getUser();
        /** @var Reporting $lastProject */
        $lastReport = $this->get('doctrine_entity_repository.reporting')
            ->findOneBy(
                ['project' => $project],
                ['user' => $user],
                ['id' => 'DESC']
            );

        return $lastReport;
    }
}
