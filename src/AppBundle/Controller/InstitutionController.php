<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Repository\InstitutionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\InstitutionsForm;
use AppBundle\Entity\Institutions;
use AppBundle\Repository\ProjectsRepository;
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
        $institutions = new Institutions();

        $institutionForm = $this->createForm(InstitutionsForm::class, $institutions, [
            'action' => $this->generateUrl('institution_create'),
            'method' => 'POST'
        ]);


        $institutionForm->handleRequest($request);

        if ($institutionForm->isSubmitted() && $institutionForm->isValid()) {
            $this->getInstitutionsRepository()->save($institutions);

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
     * @return InstitutionsRepository
     */
    private function getInstitutionsRepository() {

        return $this->get('doctrine_entity_repository.institutions');
    }
}