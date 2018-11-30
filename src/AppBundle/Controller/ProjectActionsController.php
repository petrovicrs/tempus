<?php
/**
 * Created by PhpStorm.
 * User: marjanapesic
 * Date: 4/7/18
 * Time: 1:19 PM
 */

namespace AppBundle\Controller;


use AppBundle\Repository\ProjectActionRepository;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ProjectActionsController extends AbstractController
{
    /**
     * @Route("/{locale}/admin/project-actions/list/{keyActionId}", options={"expose"=true}, name="project_actions_list", requirements={"keyActionId": "\d+", "locale": "%app.locales%"})
     */
    public function citiesAction(Request $request, $keyActionId)
    {

        $projectActions = $this->getProjectActionRepository()->findBy(['keyAction' => $keyActionId]);


        $serializer = $this->get('jms_serializer');
        $json = $serializer->serialize(
            $projectActions,
            'json',
            SerializationContext::create()->setGroups(array('main'))
        );

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json; charset=UTF-8');
        $response->setContent($json);
        return $response;
    }


    /**
     * @return ProjectActionRepository
     */
    private function getProjectActionRepository() {

        return $this->get('doctrine_entity_repository.project_action');
    }
}