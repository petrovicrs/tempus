<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Reporting;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Omines\DataTablesBundle\Controller\DataTablesTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class AbstractController
 * @package AppBundle\Controller
 */
abstract class AbstractController extends Controller {

    const MESSAGE_TYPE_SUCCESS = 'successMessage';
    const MESSAGE_TYPE_INFO = 'infoMessage';
    const MESSAGE_TYPE_WARNING = 'warningMessage';
    const MESSAGE_TYPE_DANGER = 'dangerMessage';

    use DataTablesTrait;

    /** @var string */
    private $pageTitle = '';

    /** @var string */
    private $message = '';

    /** @var int */
    private $messageType;

    /**
     * Get translated message
     *
     * @param string $string
     *
     * @param array $parameters
     * @return string
     */
    protected function translate(string $string, array $parameters = []) {
        /** @var TranslatorInterface $translator */
        $translator = $this->get('translator');
        return $translator->trans($string, $parameters);
    }

    /**
     * Set page title
     *
     * @param string $title
     */
    protected function setPageTitle(string $title) {
        $this->pageTitle = $title;
    }

    /**
     * Set success message
     *
     * @param string $message
     * @param bool $toSession
     */
    protected function setSuccessMessage(string $message, $toSession = true) {
        $this->setMessage($message, self::MESSAGE_TYPE_SUCCESS, $toSession);
    }

    /**
     * Set success message
     *
     * @param string $message
     * @param bool $toSession
     */
    protected function setInfoMessage(string $message, $toSession = true) {
        $this->setMessage($message, self::MESSAGE_TYPE_INFO, $toSession);
    }

    /**
     * Set success message
     *
     * @param string $message
     * @param bool $toSession
     */
    protected function setWarningMessage(string $message, $toSession = true) {
        $this->setMessage($message, self::MESSAGE_TYPE_WARNING, $toSession);
    }

    /**
     * Set success message
     *
     * @param string $message
     * @param bool $toSession
     */
    protected function setDangerMessage(string $message, $toSession = true) {
        $this->setMessage($message, self::MESSAGE_TYPE_DANGER, $toSession);
    }

    /**
     * Set message
     *
     * @param string $message
     * @param string $messageType
     * @param bool $toSession
     */
    private function setMessage(string $message, string $messageType, $toSession = true) {
        if ($toSession) {
            $this->get('session')->set('message', $message);
            $this->get('session')->set('messageType', $messageType);
        } else {
            $this->message = $message;
            $this->messageType = $messageType;
        }
    }

    /**
     * @param string $view
     * @param array $parameters
     * @param Response|null $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function render($view, array $parameters = array(), Response $response = null) {
        $parameters['page_title'] = $this->pageTitle;
        if (!empty($this->message)) {
            $parameters[$this->messageType] = $this->message;
        } elseif ($this->get('session')->get('message')) {
            $parameters[$this->get('session')->get('messageType')] = $this->get('session')->get('message');
            $this->get('session')->set('message', '');
            $this->get('session')->set('messageType', '');
        }
        return parent::render($view, $parameters, $response);
    }

    /**
     * @param string $route
     * @param array $parameters
     * @param int $referenceType
     *
     * @return string
     */
    protected function generateUrl(
        $route,
        $parameters = array(),
        $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH
    ) {
        if (!isset($parameters['locale'])) {
            $parameters['locale'] = $this->get('translator')->getLocale();
        }

        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }


    protected function redirectToRoute($route, array $parameters = array(), $status = 302) {
        if (!isset($parameters['locale'])) {
            $parameters['locale'] = $this->get('translator')->getLocale();
        }

        return $this->redirect($this->generateUrl($route, $parameters), $status);
    }

    /**
     * @return Project
     */
    protected function getLastProjectForCurrentUser() {
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
    protected function showActionTab(Project $project) {
//        $action = $project->getActions()->getNameSr();
//
//        if ($action == 'KA101' || $action == 'KA102' || $action == 'KA103' || $action == 'KA104' || $action == 'KA105'
//            || $action == 'KA106' || $action == 'KA107' || $action == 'KA125') {
//            return true;
//        }

        return false;
    }

    /**
     * @param $project
     * @return Reporting
     */
    protected function getLastReportForCurrentUserByProject($project): Reporting {
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
