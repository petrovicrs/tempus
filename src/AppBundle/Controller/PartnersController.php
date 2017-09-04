<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 22:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Partners;
use AppBundle\Entity\PartnersParticipants;
use AppBundle\Entity\PartnersTeamMembers;
use AppBundle\Form\PartnersForm;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $partners = new Partners();

        $partnersForm = $this->createForm(PartnersForm::class, $partners, [
            'action' => $this->generateUrl('partner_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $partnersForm->handleRequest($request);

        if ($partnersForm->isSubmitted() && $partnersForm->isValid()) {
            $partners->setProject($this->getLastProjectForCurrentUser());

            $this->getPartnersRepository()->save($partners);

            /** @var PartnersTeamMembers $member */
            foreach($partners->getTeamMembers() as $member){
                $member->setPartners($partners);
                $this->getPartnersTeamMembersRepository()->save($member);
            }

            /** @var PartnersParticipants $participant */
            foreach($partners->getParticipants() as $participant){
                $participant->setPartners($partners);
                $this->getPartnersParticipantsRepository()->save($participant);
            }

            return $this->redirectToRoute('partners_list');
        }

        return $this->render('partners/create.twig', ['my_form' => $partnersForm->createView()]);
    }

    /**
     * @Route("/{locale}/partners/edit/{id}", name="partner_edit", requirements={"id": "\d+", "locale": "%app.locales%"})
     */
    public function editAction(Request $request, $id)
    {
        $partners = $this->getPartnersRepository()->findOneBy(['id' => $id]);

        $partnersForm = $this->createForm(PartnersForm::class, $partners, [
            'action' => $this->generateUrl('partner_edit', ['id' => $id]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $teamMembers = new ArrayCollection();
        $participants = new ArrayCollection();

        foreach ($partners->getTeamMembers() as $member) {
            $teamMembers->add($member);
        }

        foreach ($partners->getParticipants() as $participant) {
            $participants->add($participant);
        }

        $partnersForm->handleRequest($request);

        if ($partnersForm->isSubmitted() && $partnersForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var PartnersTeamMembers $member */
            foreach($teamMembers as $member){
                if(false === $partners->getTeamMembers()->contains($member)) {
                    $em->remove($member);
                }
            }

            /** @var PartnersParticipants $participant */
            foreach($participants as $participant){
                if(false === $partners->getParticipants()->contains($participant)) {
                    $em->remove($participant);
                }
            }

            $this->getPartnersRepository()->save($partners);

            return $this->redirectToRoute('partners_list');
        }

        return $this->render('partners/edit.twig', ['my_form' => $partnersForm->createView()]);
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