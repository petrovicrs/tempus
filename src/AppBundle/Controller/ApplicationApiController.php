<?php
/**
 * Created by PhpStorm.
 * User: marjanapesic
 * Date: 3/24/17
 * Time: 4:09 PM
 */

namespace AppBundle\Controller;


use AppBundle\AppBundle;
use AppBundle\Entity\Application;
use AppBundle\Form\ApplicationType;
use AppBundle\Repository\ApplicationRepository;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 *
 * Class ApplicationApiController
 * @package AppBundle\Controller
 *
 * @RouteResource("applications")
 */
class ApplicationApiController extends FOSRestController implements ClassResourceInterface
{

    /**
     * Gets an individual application
     *
     * @param int $id
     * @return mixed
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Application",
     *     statusCodes={
     *          200 = "Returned when successful",
     *          404 = "Returned when not found"
     *     }
     * )
     */
    public function getAction(int $id)
    {
        return $this->getApplicationRepository()->createFindOneByIdQuery($id)->getSingleResult();
//        return $this->getDoctrine()->getRepository("AppBundle:Application")->find($id);
    }

    /**
     * Gets a collection of applications
     *
     * @return array
     *
     * @ApiDoc(
     *     output="AppBundle\Entity\Application",
     *     statusCodes={
     *          200 = "Returned when successful",
     *          404 = "Returned when not found"
     *     }
     * )
     */
    public function cgetAction()
    {
        return $this->getApplicationRepository()->createFindAllQuery()->getResult();
    }


    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="AppBundle\Form\ApplicationType",
     *     output="AppBundle\Entity\Application",
     *     statusCodes={
     *          201 = "Returned when new application has been successfully created",
     *          404 = "Returned when not found"
     *     }
     * )
     */
    public function postAction(Request $request)
    {

        $form = $this->createForm(ApplicationType::class, null, [
            'csrf_protection' => false
        ]);

        $form->submit(json_decode($request->getContent(), true));

        if(!$form->isValid())
        {
            return $form;
        }

        /** @var Application $application */
        $application = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($application);
        $em->flush();


        $routeOptions = [
            'id' => $application->getId(),
            '_format' => $request->get('_format')
        ];

        return $this->routeRedirectView('get_applications', $routeOptions, Response::HTTP_CREATED);
    }

    /**
     * @return ApplicationRepository
     */
    private function getApplicationRepository()
    {
        return $this->get('doctrine_entity_repository.application');
    }



    /**
     * @param Request $request
     * @return \FOS\RestBundle\View\View|\Symfony\Component\Form\Form
     *
     * @ApiDoc(
     *     input="AppBundle\Form\ApplicationType",
     *     statusCodes={
     *          201 = "Returned when new application has been successfully created",
     *          404 = "Returned when not found"
     *     }
     * )
     */
    public function postUploadAction(Request $request)
    {
        //$uploadedfile = $request->files->get('file');
        $directory = __DIR__.'/../../../web/uploads';

        foreach($request->files as $uploadedFile) {
            file_put_contents("/test.txt", $uploadedFile->getClientOriginalName());
            $file = $uploadedFile->move($directory, $uploadedFile->getClientOriginalName());

        }

        $routeOptions = [
            '_format' => $request->get('_format')
        ];

        return $this->routeRedirectView('cget_applications', $routeOptions, Response::HTTP_CREATED);
    }
}