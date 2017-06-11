<?php
/**
 * Created by PhpStorm.
 * User: marjanapesic
 * Date: 3/24/17
 * Time: 11:38 AM
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Application;


class ApplicationController extends FOSRestController
{

    /**
     * @Rest\Get("/application")
     */
    public function getAction()
    {
        $repo = $this->getDoctrine()->getRepository('AppBundle:Application');
        $restresult = $repo->findAll();

        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }


    /**
     * @Rest\Get("/application/{id}")
     */
    public function idAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Application')->find($id);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }


    /**
     * @Rest\Post("/application")
     */
    public function postAction(Request $request)
    {
        $application = new Application();
        $data = json_decode($request->getContent());

        $firstName = $data->first_name;
        $lastName = $data->last_name;
        $emailAddress = $data->email_address;

        if (empty($firstName) || empty($lastName) || empty($emailAddress)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $application->setFirstName($firstName);
        $application->setLastName($lastName);
        $application->setEmailAddress($emailAddress);

        $em = $this->getDoctrine()->getManager();
        $em->persist($application);
        $em->flush();

        return new View("User Added Successfully", Response::HTTP_OK);
    }
}