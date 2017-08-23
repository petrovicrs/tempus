<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;


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

    protected function getLastProjectForCurrentUser()
    {
        $user = $this->getUser();
        $lastProject = $this->get('doctrine_entity_repository.project')
            ->findOneBy(
                ['user' => $user], 'DESC'
            );

        return $lastProject;
    }
}
