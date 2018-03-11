<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/3/17
 * Time: 7:34 PM
 */
namespace AppBundle\Controller;

use AppBundle\Entity\InstitutionAccreditation;
use AppBundle\Entity\InstitutionAddress;
use AppBundle\Entity\InstitutionContact;
use AppBundle\Entity\InstitutionLegalRepresentative;
use AppBundle\Entity\InstitutionNote;
use AppBundle\Entity\PicNumber;
use AppBundle\Entity\ProjectReporting;
use AppBundle\Repository\InstitutionContactRepository;
use AppBundle\Repository\InstitutionRepository;
use AppBundle\Repository\PersonInstitutionRelationshipRepository;
use AppBundle\Repository\PersonRepository;
use AppBundle\Repository\PicNumberRepository;
use AppBundle\Repository\InstitutionNoteRepository;
use AppBundle\Repository\InstitutionAddressRepository;
use AppBundle\Repository\InstitutionLegalRepresentativeRepository;
use AppBundle\Repository\InstitutionAccreditationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\InstitutionsForm;
use AppBundle\Entity\Institution;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

class InstitutionController extends AbstractController
{
    /**
     * @Route("/{locale}/institution/list", name="institution_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction()
    {
        $institutions = $this->getInstitutionRepository()->findAll();

        return $this->render('institution/list.twig', ['result' => $institutions]);
    }

    /**
     * @Route("/{locale}/institution/create", name="institution_create", requirements={"locale": "%app.locales%"})
     *
     */
    public function createAction(Request $request)
    {
        $institutions = new Institution();

        $institutionForm = $this->createForm(InstitutionsForm::class, $institutions, [
            'action' => $this->generateUrl('institution_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);


        $institutionForm->handleRequest($request);

        if ($institutionForm->isSubmitted() && $institutionForm->isValid()) {
            $this->getInstitutionRepository()->save($institutions);

            /** @var PicNumber $picNumber */
            foreach($institutions->getPicNumber() as $picNumber){
                $picNumber->setInstitution($institutions);
                $this->getPicNumberRepository()->save($picNumber);
            }

            /** @var InstitutionContact $contact */
            foreach($institutions->getContacts() as $contact){
                $contact->setInstitution($institutions);
                $this->getInstitutionContactRepository()->save($contact);
            }

            /** @var InstitutionAccreditation $accreditation */
            foreach($institutions->getAddresses() as $accreditation){
                $accreditation->setInstitution($institutions);
                $this->getInstitutionAccreditationRepository()->save($accreditation);
            }

            /** @var InstitutionAddress $address */
            foreach($institutions->getAddresses() as $address){
                $address->setInstitution($institutions);
                $this->getInstitutionAddressRepository()->save($address);
            }

            /** @var InstitutionNote $note */
            foreach($institutions->getNotes() as $note){
                $note->setInstitution($institutions);
                $this->getInstitutionNoteRepository()->save($note);
            }

            /** @var InstitutionLegalRepresentative $legalRepresentative */
            foreach($institutions->getLegalRepresentatives() as $legalRepresentative){
                $legalRepresentative->setInstitution($institutions);
                $this->getInstitutionLegalRepresentativeRepository()->save($legalRepresentative);
            }
            return $this->redirectToRoute('institution_list');

        }

        return $this->render('institution/create.twig', ['my_form' => $institutionForm->createView()]);
    }

    /**
     * @Route("/{locale}/institution/edit/{institutionId}", name="institution_edit", requirements={"institutionId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $institutionId)
    {
        /** @var Institution $institution */
        $institution = $this->getInstitutionRepository()->findOneBy(['id' => $institutionId]);

        $institutionForm = $this->createForm(InstitutionsForm::class, $institution, [
            'action' => $this->generateUrl('institution_edit', ['institutionId' => $institutionId]),
            'method' => 'POST',
        ]);

        $originalPicNumbers = new ArrayCollection();
        $originalContacts = new ArrayCollection();
        $originalAddresses = new ArrayCollection();
        $originalAccreditations = new ArrayCollection();
        $originalNotes = new ArrayCollection();
        $originalLegalRepresentatives = new ArrayCollection();

        foreach ($institution->getPicNumber() as $picNumber) {
            $originalPicNumbers->add($picNumber);
        }

        foreach ($institution->getContacts() as $contact){
            $originalContacts->add($contact);
        }

        foreach ($institution->getAddresses() as $address){
            $originalAddresses->add($address);
        }

        foreach ($institution->getAccreditations() as $accreditation){
            $originalAccreditations->add($accreditation);
        }

        foreach ($institution->getNotes() as $note){
            $originalNotes->add($note);
        }

        foreach ($institution->getLegalRepresentatives() as $legalRepresentative){
            $originalLegalRepresentatives->add($legalRepresentative);
        }

        $institutionForm->handleRequest($request);

        if ($institutionForm->isSubmitted() && $institutionForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach ($originalPicNumbers as $picNumber) {
                if (false === $institution->getPicNumber()->contains($picNumber)) {
                    $em->remove($picNumber);
                }
            }

            /** @var PicNumber $picNumber */
            foreach ($institution->getPicNumber() as $picNumber) {
                if (false === $originalPicNumbers->contains($picNumber)) {
                    $picNumber->setInstitution($institution);
                    $this->getPicNumberRepository()->save($picNumber);
                }
            }

            foreach ($originalContacts as $originalContact) {
                if (false === $institution->getContacts()->contains($originalContact)) {
                    $em->remove($originalContact);
                }
            }

            /** @var InstitutionContact $contact */
            foreach ($institution->getContacts() as $contact) {
                if (false === $originalContacts->contains($contact)) {
                    $contact->setInstitution($institution);
                    $this->getInstitutionContactRepository()->save($contact);
                }
            }

            foreach ($originalAddresses as $originalAddress) {
                if (false === $institution->getAddresses()->contains($originalAddress)) {
                    $em->remove($originalAddress);
                }
            }

            /** @var InstitutionAddress $address */
            foreach ($institution->getAddresses() as $address) {
                if (false === $originalNotes->contains($address)) {
                    $address->setInstitution($institution);
                    $this->getInstitutionAddressRepository()->save($address);
                }
            }

            foreach ($originalAccreditations as $originalAccreditation) {
                if (false === $institution->getAccreditations()->contains($originalAccreditation)) {
                    $em->remove($originalAccreditation);
                }
            }

            /** @var InstitutionAccreditation $accreditation */
            foreach ($institution->getAccreditations() as $accreditation) {
                if (false === $originalAccreditations->contains($accreditation)) {
                    $accreditation->setInstitution($institution);
                    $this->getInstitutionAccreditationRepository()->save($accreditation);
                }
            }

            foreach ($originalNotes as $note) {
                if (false === $institution->getNotes()->contains($note)) {
                    $em->remove($note);
                }
            }

            /** @var InstitutionNote $note */
            foreach ($institution->getNotes() as $note) {
                if (false === $originalNotes->contains($note)) {
                    $note->setInstitution($institution);
                    $this->getInstitutionNoteRepository()->save($note);
                }
            }

            foreach ($originalLegalRepresentatives as $originalLegalRepresentative) {
                if (false === $institution->getLegalRepresentatives()->contains($originalLegalRepresentative)) {
                    $em->remove($originalLegalRepresentative);
                }
            }

            /** @var InstitutionLegalRepresentative $legalRepresentative */
            foreach ($institution->getLegalRepresentatives() as $legalRepresentative) {
                if (false === $originalLegalRepresentatives->contains($legalRepresentative)) {
                    $legalRepresentative->setInstitution($institution);
                    $this->getInstitutionLegalRepresentativeRepository()->save($legalRepresentative);
                }
            }

            $this->getInstitutionRepository()->save($institution);

            return $this->redirectToRoute('institution_list');
        }

        return $this->render('institution/edit.twig', ['my_form' => $institutionForm->createView()]);
    }

    /**
     * @Route("/{locale}/institution/view/{institutionId}", name="institution_view", requirements={"institutionId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($institutionId)
    {
        $institution = $this->getInstitutionRepository()->findOneBy(['id' => $institutionId]);

        $picNumbers = $this->getPicNumberRepository()->findBy(['institution' => $institutionId]);
        $contacts = $this->getInstitutionContactRepository()->findBy(['institution' => $institutionId]);
        $addresses = $this->getInstitutionAddressRepository()->findBy(['institution' => $institutionId]);
        $accreditations = $this->getInstitutionAccreditationRepository()->findBy(['institution' => $institutionId]);
        $notes = $this->getInstitutionNoteRepository()->findBy(['institution' => $institutionId]);
        $legalRepresentatives = $this->getInstitutionLegalRepresentativeRepository()->findBy(['institution' => $institutionId]);
        $employees = $this->getPersonInstitutionRelationshipRepository()->findBy(['institution' => $institutionId]);
        $affiliatedInstitutionsOrganizations = $this->getInstitutionRepository()->findBy(['parentInstitution' => $institutionId]);
        $affiliatedProjects = $this->getProjectPartnerOrganisationRepository()->findBy(['organisation' => $institutionId]);

        return $this->render('institution/view.twig', ['institution' => $institution, 'picNumbers' => $picNumbers, 'contacts' => $contacts, 'addresses' => $addresses,
            'accreditations' => $accreditations, 'notes' => $notes, 'legalRepresentatives' => $legalRepresentatives, 'employees' => $employees,
            'affiliatedInstitutionsOrganizations' => $affiliatedInstitutionsOrganizations, 'affiliatedProjects' => $affiliatedProjects]);
    }

    /**
     * @return InstitutionRepository
     */
    private function getInstitutionRepository() {

        return $this->get('doctrine_entity_repository.institution');
    }

    /**
     * @return PicNumberRepository
     */
    private function getPicNumberRepository() {

        return $this->get('doctrine_entity_repository.pic_number');
    }

    /**
     * @return InstitutionContactRepository
     */
    private function getInstitutionContactRepository() {

        return $this->get('doctrine_entity_repository.institution_contact');
    }

    /**
     * @return InstitutionAccreditationRepository
     */
    private function getInstitutionAccreditationRepository() {

        return $this->get('doctrine_entity_repository.institution_accreditation');
    }

    /**
     * @return InstitutionAddressRepository
     */
    private function getInstitutionAddressRepository() {

        return $this->get('doctrine_entity_repository.institution_address');
    }

    /**
     * @return InstitutionNoteRepository
     */
    private function getInstitutionNoteRepository() {

        return $this->get('doctrine_entity_repository.institution_note');
    }

    /**
     * @return InstitutionLegalRepresentativeRepository
     */
    private function getInstitutionLegalRepresentativeRepository() {

        return $this->get('doctrine_entity_repository.institution_legal_representative');
    }

    /**
     * @return PersonInstitutionRelationshipRepository
     */
    private function getPersonInstitutionRelationshipRepository() {

        return $this->get('doctrine_entity_repository.person_institution_relationship');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectPartnerOrganisationRepository() {

        return $this->get('doctrine_entity_repository.project_partner_organisation');
    }
}