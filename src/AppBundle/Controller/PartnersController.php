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
use AppBundle\Form\ProjectPartnersForm;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class PartnersController extends AbstractController
{
    /**
     * @Route("/{locale}/partners/list", name="partners_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $partners = $this->getPartnersRepository()->findAll();
        return $this->render('partners/list.twig', ['partners' => $partners]);
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

        $projectPartnersForm = $this->createForm(ProjectPartnersForm::class, $projectPartners, [
            'action' => $this->generateUrl('partner_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $projectPartners->getProject()->getIsCompleted(),
        ]);

        $partners = new ArrayCollection();
        $participants = new ArrayCollection();
        $teamMembers = new ArrayCollection();

        /** @var Partners $partner */
        foreach ($projectPartners->getPartners() as $partner) {
            $partners->add($partner);

            foreach ($partner->getTeamMembers() as $member) {
                $teamMembers->add($member);
            }
        }

        foreach ($projectPartners->getParticipants() as $participant) {
            $participants->add($participant);
        }

        $projectPartnersForm->handleRequest($request);

        if ($projectPartnersForm->isSubmitted() && $projectPartnersForm->isValid()) {

            $em = $this->getDoctrine()->getManager();


            foreach ($partners as $partner) {
                if(false === $projectPartners->getPartners()->contains($partner)) {
                    $em->remove($partner);
                }

                /** @var PartnersTeamMembers $member */
                foreach($teamMembers as $member){
                    if(false === $partner->getTeamMembers()->contains($member)) {
                        $em->remove($member);
                    }
                }

                $this->getPartnersRepository()->save($partners);
            }

            /** @var PartnersParticipants $participant */
            foreach($participants as $participant){
                if(false === $projectPartners->getParticipants()->contains($participant)) {
                    $em->remove($participant);
                }
            }

            $this->getProjectPartnersRepository()->save($partners);

            if (!$partners->getProject()->getIsCompleted()) {
                return $this->redirectToRoute('resources_create');
            }
        }

        return $this->render('partners/edit.twig', ['my_form' => $projectPartnersForm->createView(), 'projectId' => $projectId]);
    }

    /**
     * @Route("/{locale}/partners/view/{id}", name="partner_view", requirements={"id": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($id)
    {
        $partner = $this->getPartnersRepository()->findOneBy(['id' => $id]);
        $teamMembers = $this->get('doctrine_entity_repository.partners_team_members')->findBy(['partners' => $id]);
        $participants = $this->get('doctrine_entity_repository.partners_participants')->findBy(['partners' => $id]);

        return $this->render('partners/view.twig', ['partner' => $partner, 'teamMembers' => $teamMembers, 'participants' => $participants]);
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
}