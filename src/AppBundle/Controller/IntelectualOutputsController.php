<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 09.08.17
 * Time: 22:32
 */

namespace AppBundle\Controller;

use AppBundle\Entity\IntelectualOutputs;
use AppBundle\Form\IntelectualOutputsForm;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class IntelectualOutputsController extends AbstractController
{
    /**
     * @Route("/{locale}/intelectual-outputs/list", name="intelectual_outputs_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $intelectualOutputs = $this->getIntelectualOutputsRepository()->findAll();

        return $this->render('intelectual-outputs/list.twig', ['intelectualOutputs' => $intelectualOutputs]);
    }

    /**
     * @Route("/{locale}/intelectual-outputs/create", name="intelectual_outputs_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $intelectualOutputs = new IntelectualOutputs();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $intelectualOutputsForm = $this->createForm(IntelectualOutputsForm::class, $intelectualOutputs, [
            'action' => $this->generateUrl('intelectual_outputs_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $intelectualOutputsForm->handleRequest($request);

        if ($intelectualOutputsForm->isSubmitted() && $intelectualOutputsForm->isValid()) {

            $intelectualOutputs->setProject($this->getLastProjectForCurrentUser());
            $this->getIntelectualOutputsRepository()->save($intelectualOutputs);

            return $this->redirectToRoute('results_create');
        }

        return $this->render('intelectual-outputs/create.twig', ['my_form' => $intelectualOutputsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr()
        ]);
    }

    /**
     * @Route("/{locale}/intelectual-outputs/edit/{id}", name="intelectual_output_edit", requirements={"id": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $id)
    {
        $intelectualOutput = $this->getIntelectualOutputsRepository()->findOneBy(['id' => $id]);

        $intelectualOutputForm = $this->createForm(IntelectualOutputsForm::class, $intelectualOutput, [
            'action' => $this->generateUrl('intelectual_output_edit', ['id' => $id]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $intelectualOutputForm->handleRequest($request);

        if ($intelectualOutputForm->isSubmitted() && $intelectualOutputForm->isValid()) {
            $this->getIntelectualOutputsRepository()->save($output);

            return $this->redirectToRoute('intelectual_outputs_list');
        }

        return $this->render('intelectual-outputs/edit.twig', ['my_form' => $intelectualOutputForm->createView()]);
    }

    /**
     * @Route("/{locale}/intelectual-outputs/view/{id}", name="intelectual_output_view", requirements={"id": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($id)
    {
        $intelectualOutput = $this->getIntelectualOutputsRepository()->findOneBy(['id' => $id]);

        return $this->render('intelectual-outputs/view.twig', ['intelectualOutput' => $intelectualOutput]);
    }

    private function getIntelectualOutputsRepository()
    {
        return $this->get('doctrine_entity_repository.intelectual_outputs');
    }
}