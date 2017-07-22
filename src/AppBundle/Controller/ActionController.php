<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 00:25
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Action;
use AppBundle\Entity\ActionDetails;
use AppBundle\Entity\Activity;
use AppBundle\Form\ActionDetailsForm;
use AppBundle\Form\ActionForm;
use AppBundle\Form\ActivityForm;
use AppBundle\Repository\ActivityRepository;
use PhpOption\Tests\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ActionController extends AbstractController
{
    /**
     * @Route("/{locale}/action/list", name="action_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $activities = $this->getActivityRepository()->findAll();
//        var_dump($activities[0]->getActionDetails());die;

        return $this->render('action/list.twig', ['activities' => $activities]);
    }

    /**
     * @Route("/{locale}/action/create", name="action_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $activity = new Activity();

        $activityForm = $this->createForm(ActivityForm::class, $activity, [
            'action' => $this->generateUrl('action_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $activityForm->handleRequest($request);

        if ($activityForm->isSubmitted() && $activityForm->isValid()) {
            $this->getActivityRepository()->saveActivity($activity);


            foreach($activity->getActionDetails() as $action){
                $action->setActivity($activity);
                $this->getActionDetailsRepository()->saveAction($action);
            }

            return $this->redirectToRoute('action_list');
        }

        return $this->render('action/create.twig', ['my_form' => $activityForm->createView()]);
    }

    /**
     * @return ActivityRepository
     */
    private function getActivityRepository() {

        return $this->get('doctrine_entity_repository.activity');
    }

    /**
     * @return ActivityRepository
     */
    private function getActionDetailsRepository() {

        return $this->get('doctrine_entity_repository.action_details');
    }
}