<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Repository\InstitutionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\InstitutionsForm;
use AppBundle\Entity\Institution;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class InstitutionController extends AbstractController
{
//    /**
//     * @Route("/{locale}/institution/list", name="institution_list", requirements={"locale": "%app.locales%"})
//     */
//    public function listAction()
//    {
//        $institutions = $this->getInstitutionsRepository()->findAll();
//
//        return $this->render('institution/list.twig', ['institutions' => $institutions]);
//    }

    /**
     * @Route("/{locale}/institution/create", name="institution_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $institutions = new Institution();

        $institutionForm = $this->createForm(InstitutionsForm::class, $institutions, [
            'action' => $this->generateUrl('institution_create'),
            'method' => 'POST'
        ]);


        $institutionForm->handleRequest($request);

        if ($institutionForm->isSubmitted() && $institutionForm->isValid()) {
            $this->getInstitutionRepository()->save($institutions);

            return $this->redirectToRoute('project_list');

        }

        return $this->render('institution/create.twig', ['my_form' => $institutionForm->createView()]);
    }

//    /**
//     * @Route("/{locale}/institution/view/{institutionId}", name="institution_view", requirements={"institutionId": "\d+", "locale": "%app.locales%"})
//     */
//    public function viewAction($institutionId)
//    {
//        $institution = $this->getInstitutionsRepository()->findOneBy(['id' => $institutionId]);
//
//        return $this->render('institution/view.twig', ['institution' => $institution]);
//    }

    /**
     * @return InstitutionRepository
     */
    private function getInstitutionRepository() {

        return $this->get('doctrine_entity_repository.institution');
    }
}