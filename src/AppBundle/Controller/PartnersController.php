<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 22:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Partners;
use AppBundle\Entity\Project;
use AppBundle\Entity\PartnersParticipants;
use AppBundle\Entity\PartnersTeamMembers;
use AppBundle\Entity\ProjectPartners;
use AppBundle\Repository\ProjectRepository;
use AppBundle\Form\ProjectPartnersForm;
use Doctrine\Common\Collections\ArrayCollection;
use function PHPSTORM_META\type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PartnersController extends AbstractController
{
    /**
     * @Route("/{locale}/partners/list", name="partners_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $partners = $this->getProjectPartnersRepository()->findAll();
        return $this->render('partners/list.twig', [
            'partners' => $partners
        ]);
    }

    /**
     * @Route("/{locale}/partners/create", name="partner_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectPartners = new ProjectPartners();

        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectPartnersForm = $this->createForm(ProjectPartnersForm::class, $projectPartners, [
            'action' => $this->generateUrl('partner_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $projectPartnersForm->handleRequest($request);

        if ($projectPartnersForm->isSubmitted() && $projectPartnersForm->isValid()) {

            $projectPartners->setProject($this->getLastProjectForCurrentUser());

            /** @var Partners $partner */
            foreach ($projectPartners->getPartners() as $partner) {

                $partner->setProjectPartners($projectPartners);

                /** @var PartnersTeamMembers $member */
                foreach($partner->getTeamMembers() as $member){
                    $member->setPartners($partner);
//                    $this->getPartnersTeamMembersRepository()->save($member);
                }
            }

            /** @var PartnersParticipants $participant */
            foreach($projectPartners->getParticipants() as $participant){
                $participant->setProjectPartners($projectPartners);
            }

            $this->getProjectPartnersRepository()->save($projectPartners);

            return $this->redirectToRoute('resources_create');
        }

        return $this->render('partners/create.twig',
            [
                'my_form' => $projectPartnersForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId()
            ]
        );
    }

    /**
     * @Route("/{locale}/partners/edit/{projectId}", name="partner_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectPartners $projectPartners */
        $projectPartners = $this->getProjectPartnersRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        $projectPartnersForm = $this->createForm(ProjectPartnersForm::class, $projectPartners, [
            'action' => $this->generateUrl('partner_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $originalPartners = new ArrayCollection();
        //$originalParticipants = [];
        $originalTeamMembers = [];

        if($projectPartners) {
            /** @var Partners $partner */
            foreach ($projectPartners->getPartners() as $partner) {
                $originalPartners->add($partner);
                $originalTeamMembers[$partner->getId()] = new ArrayCollection();

                if (count($partner->getTeamMembers())) {
                    foreach ($partner->getTeamMembers() as $member) {
                        $originalTeamMembers[$partner->getId()]->add($member);
                    }
                }
            }

            //        foreach ($projectPartners->getParticipants() as $participant) {
//            $originalParticipants->add($participant);
//        }
        }

        $projectPartnersForm->handleRequest($request);

        if ($projectPartnersForm->isSubmitted() && $projectPartnersForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            if (count($originalPartners)) {
                /** @var Partners $partner */
                foreach ($originalPartners as $partner) {
                    if(false === $projectPartners->getPartners()->contains($partner)) {
                        $em->remove($partner);
                    }

                    if (count($partner->getTeamMembers())) {
                        foreach ($originalTeamMembers[$partner->getId()] as $originalTeamMember) {
                            if(false === $partner->getTeamMembers()->contains($originalTeamMember)) {
                                $em->remove($originalTeamMember);
                            }
                        }







//                        /** @var PartnersTeamMembers $member */
//                        foreach($partner->getTeamMembers() as $member){
//                            /** @var Partners $partner */
//                            foreach($originalParticipants[$partner->getId()] as $participant) {
//                                if(false === $partner->getTeamMembers()->contains($member)) {
//                                    $em->remove($member);
//                                }
//                            }
//                        }
                    }
                }
            }

            /** @var Partners $partner */
            foreach ($projectPartners->getPartners() as $partner) {
                if (false === $originalPartners->contains($partner)) {
                    $partner->setProjectPartners($projectPartners);
                    $this->getPartnersRepository()->save($partner);
                }

                if (count($partner->getTeamMembers())) {
                    /** @var PartnersTeamMembers $member */
                    foreach($partner->getTeamMembers() as $member) {
                        if( isset($originalTeamMembers[$partner->getId()]) && false === $originalTeamMembers[$partner->getId()]->contains($member)){
                            $member->setPartners($partner);
                            $this->getPartnersTeamMembersRepository()->save($member);
                        }
                    }
                }

            }

//            /** @var PartnersParticipants $participant */
//            foreach($originalParticipants as $participant){
//                if(false === $projectPartners->getParticipants()->contains($participant)) {
//                    $em->remove($participant);
//                }
//            }

//            /** @var PartnersParticipants $participant */
//            foreach ($projectPartners->getParticipants() as $participant) {
//                if (false === $originalParticipants->contains($participant)) {
//                    $participant->setProjectResults($projectResult);
//                    $this->getResultsRepository()->save($result);
//                }
//            }

            $this->getProjectPartnersRepository()->save($projectPartners);

            if (!$projectPartners->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('resources_create');
            }
        }

        return $this->render('partners/edit.twig',
            [
                'my_form' => $projectPartnersForm->createView(),
                'projectId' => $projectId,
                'isCompleted' => $project->getIsCompleted(),
            ]
        );
    }

    /**
     * @Route("/{locale}/partners/view/{projectId}", name="partner_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        $projectPartner = $this->getProjectPartnersRepository()->findOneBy(['project' => $projectId]);
//        $teamMembers = $this->get('doctrine_entity_repository.partners_team_members')->findBy(['partners' => $projectId]);
//        $participants = $this->get('doctrine_entity_repository.partners_participants')->findBy(['partners' => $projectId]);

        return $this->render('partners/view.twig', [
            'projectPartner' => $projectPartner,
            'projectId' => $projectId,
            'keyAction' => $projectPartner->getProject()->getKeyActions()->getNameSr()
        ]);
    }

    private function getProjectPartnersRepository()
    {
        return $this->get('doctrine_entity_repository.project_partners');
    }

    private function getPartnersRepository()
    {
        return $this->get('doctrine_entity_repository.partners');
    }

    private function getPartnersTeamMembersRepository()
    {
        return $this->get('doctrine_entity_repository.partners_team_members');
    }

    private function getPartnersParticipantsRepository()
    {
        return $this->get('doctrine_entity_repository.partners_participants');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }
}