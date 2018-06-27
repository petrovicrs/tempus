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
use AppBundle\Entity\InstitutionRiskLevel;
use AppBundle\Entity\PicNumber;
use AppBundle\Form\RiskLevelForm;
use AppBundle\Repository\FileRepository;
use AppBundle\Repository\InstitutionContactRepository;
use AppBundle\Repository\InstitutionRepository;
use AppBundle\Repository\InstitutionRiskLevelRepository;
use AppBundle\Repository\PersonInstitutionRelationshipRepository;
use AppBundle\Repository\PersonRepository;
use AppBundle\Repository\PicNumberRepository;
use AppBundle\Repository\InstitutionNoteRepository;
use AppBundle\Repository\InstitutionAddressRepository;
use AppBundle\Repository\InstitutionLegalRepresentativeRepository;
use AppBundle\Repository\InstitutionAccreditationRepository;
use AppBundle\Repository\UserInstitutionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Form\InstitutionsForm;
use AppBundle\Entity\Institution;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use AppBundle\Util\FileTypeHelper;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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
     * @Security("is_granted('ROLE_USER_CREATE') or is_granted('ROLE_USER_INSTITUTION_CREATE') or is_granted('ROLE_ADMIN')")
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


            if($institutionForm->has('riskLevel')){

                $riskLevelDataCollection = $institutionForm->get('riskLevel')->getData();
                foreach ($riskLevelDataCollection as $riskLevelData){

                    /** @var UploadedFile $file */
                    $file = $riskLevelData['file'];

                    if (false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {
                        /** @var File $uploadedFile */
                        $uploadedFile = $this->get('util.file_uploader')->upload($file);

                        $fileEntity = new \AppBundle\Entity\File();
                        $fileEntity->setFile($uploadedFile->getFilename());
                        $fileEntity->setType($file->getClientOriginalExtension());
                        $fileEntity->setOriginalFileName($file->getClientOriginalName());

                        $this->getFileRepository()->save($fileEntity);

                        $riskLevel = new InstitutionRiskLevel();
                        $riskLevel->setInstitution($institutions);
                        $riskLevel->setFile($fileEntity);
                        $riskLevel->setRiskLevelType($riskLevelData['riskLevelType']);

                        $this->getInstitutionRiskLevelRepository()->save($riskLevel);
                    }
                }
            }

            return $this->redirectToRoute('institution_list');

        }

        return $this->render('institution/create.twig', ['my_form' => $institutionForm->createView()]);
    }

    /**
     * @Route("/{locale}/institution/edit/{institutionId}", name="institution_edit", requirements={"institutionId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER_EDIT') or is_granted('ROLE_USER_INSTITUTION_EDIT_MY') or is_granted('ROLE_USER_INSTITUTION_EDIT_ALL') or is_granted('ROLE_ADMIN')")
     */
    public function editAction(Request $request, $institutionId)
    {
        /** @var Institution $institution */
        $institution = $this->getInstitutionRepository()->findOneBy(['id' => $institutionId]);

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER_INSTITUTION_EDIT_MY') &&
            $this->get('security.authorization_checker')->isGranted('ROLE_USER_EDIT') &&
            $this->get('security.authorization_checker')->isGranted('ROLE_USER_INSTITUTION_EDIT_ALL') &&
            $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            if (!$this->getUserInstitutionRepository()->isUserInstitution($institution, $this->getUser())) {
                // Permissions were denied
                throw new AccessDeniedException("You don't have access to this page!");
            }
        }

        $institutionForm = $this->createForm(InstitutionsForm::class, $institution, [
            'action' => $this->generateUrl('institution_edit', ['institutionId' => $institutionId]),
            'method' => 'POST',
        ]);

        /**
         * Create existing risk level form entries
         */
        /** @var Form $risKLevelForm */
        $risKLevelForm = $institutionForm->get('riskLevel');

        $riskLevels = $this->getInstitutionRiskLevelRepository()->findBy(['institution' => $institution]);

        $i = 0;
        /** @var InstitutionRiskLevel $riskLevel */
        foreach ($riskLevels as $riskLevel) {

            $file = new \Symfony\Component\HttpFoundation\File\File($this->get('util.file_uploader')->getTargetDir()."/".$riskLevel->getFile()->getFile());
            $element['riskLevelType'] = $riskLevel->getRiskLevelType();
            $element['riskLevelId'] = $riskLevel->getId();
            $element['file'] = $file;

            $options = [
                'file_path'=> '/'.$request->getLocale().'/institution/'.$institutionId.'/file/risk-level/'.$riskLevel->getId(),
                'file_name'=> $riskLevel->getFile()->getOriginalFileName()
            ];
            $i++;
            /** @var FormBuilder $riskLevelFormBuilder */
            $riskLevelFormBuilder= $this->get('form.factory')->createNamedBuilder( ''.$i, RiskLevelForm::class, $element, $options);
            $risKLevelForm->add($riskLevelFormBuilder->getForm());
        }


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

            if($institutionForm->has('riskLevel')){

                $newRiskLevelDataCollection = $institutionForm->get('riskLevel')->getData();
                $existingRiskLevels = [];

                foreach ($newRiskLevelDataCollection as $riskLevelData){

                    if(isset($riskLevelData['riskLevelId'])){
                        $existingRiskLevels[] = $riskLevelData['riskLevelId'];
                        $riskLevel = $this->getInstitutionRiskLevelRepository()->find($riskLevelData['riskLevelId']);
                        $riskLevel->setRiskLevelType($riskLevelData['riskLevelType']);
                    }
                    else {
                        /** @var UploadedFile $file */
                        $file = $riskLevelData['file'];

                        if (false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {
                            /** @var File $uploadedFile */
                            $uploadedFile = $this->get('util.file_uploader')->upload($file);

                            $fileEntity = new \AppBundle\Entity\File();
                            $fileEntity->setFile($uploadedFile->getFilename());
                            $fileEntity->setType($file->getClientOriginalExtension());
                            $fileEntity->setOriginalFileName($file->getClientOriginalName());

                            $this->getFileRepository()->save($fileEntity);

                            $riskLevel = new InstitutionRiskLevel();
                            $riskLevel->setInstitution($institution);
                            $riskLevel->setFile($fileEntity);
                            $riskLevel->setRiskLevelType($riskLevelData['riskLevelType']);

                            $this->getInstitutionRiskLevelRepository()->save($riskLevel);
                        }
                    }
                }

                foreach ($riskLevels as $riskLevel){
                    if(!in_array($riskLevel->getId(), $existingRiskLevels)) {
                        /** @var \AppBundle\Entity\File $fileEntity */
                        $fileEntity = $riskLevel->getFile();
                        $this->get('util.file_uploader')->remove($fileEntity->getFile());
                        $em->remove($riskLevel);
                    }
                }
            }

            $this->getInstitutionRepository()->save($institution);

            return $this->redirectToRoute('institution_list');
        }

        return $this->render('institution/edit.twig', ['my_form' => $institutionForm->createView(), 'institution' => $institution]);
    }

    /**
     * @Route("/{locale}/institution/view/{institutionId}", name="institution_view", requirements={"institutionId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER_VIEW') or is_granted('ROLE_USER_INSTITUTION_VIEW_MY') or is_granted('ROLE_USER_INSTITUTION_VIEW_ALL') or is_granted('ROLE_ADMIN')")
     */
    public function viewAction(Request $request, $institutionId)
    {
        $institution = $this->getInstitutionRepository()->findOneBy(['id' => $institutionId]);

        if ($this->get('security.authorization_checker')->isGranted('ROLE_USER_INSTITUTION_VIEW_MY') &&
            $this->get('security.authorization_checker')->isGranted('ROLE_USER_VIEW') &&
            $this->get('security.authorization_checker')->isGranted('ROLE_USER_INSTITUTION_VIEW_ALL') &&
            $this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            if (!$this->getUserInstitutionRepository()->isUserInstitution($institution, $this->getUser())) {
                // Permissions were denied
                throw new AccessDeniedException("You don't have access to this page!");
            }
        }

        $picNumbers = $this->getPicNumberRepository()->findBy(['institution' => $institutionId]);
        $contacts = $this->getInstitutionContactRepository()->findBy(['institution' => $institutionId]);
        $addresses = $this->getInstitutionAddressRepository()->findBy(['institution' => $institutionId]);
        $accreditations = $this->getInstitutionAccreditationRepository()->findBy(['institution' => $institutionId]);
        $notes = $this->getInstitutionNoteRepository()->findBy(['institution' => $institutionId]);
        $legalRepresentatives = $this->getInstitutionLegalRepresentativeRepository()->findBy(['institution' => $institutionId]);
        $employees = $this->getPersonInstitutionRelationshipRepository()->findBy(['institution' => $institutionId]);
        $affiliatedInstitutionsOrganizations = $this->getInstitutionRepository()->findBy(['parentInstitution' => $institutionId]);
        $affiliatedProjects = $this->getProjectPartnerOrganisationRepository()->findBy(['organisation' => $institutionId]);
        $institutionRiskLevels = $this->getInstitutionRiskLevelRepository()->findBy(['institution' => $institutionId]);

        $institutionRiskLevelFiles = [];
        /** @var InstitutionRiskLevel $riskLevel */
        foreach($institutionRiskLevels as $riskLevel) {
            $institutionRiskLevelFiles[$riskLevel->getId()]['file_name'] = $riskLevel->getFile()->getOriginalFileName();
            $institutionRiskLevelFiles[$riskLevel->getId()]['file_path'] = '/'.$request->getLocale().'/institution/'.$institutionId.'/file/risk-level/'.$riskLevel->getId();
        }

        return $this->render('institution/view.twig', ['institution' => $institution, 'picNumbers' => $picNumbers, 'contacts' => $contacts, 'addresses' => $addresses,
            'accreditations' => $accreditations, 'notes' => $notes, 'legalRepresentatives' => $legalRepresentatives, 'employees' => $employees,
            'affiliatedInstitutionsOrganizations' => $affiliatedInstitutionsOrganizations, 'affiliatedProjects' => $affiliatedProjects,
            'institutionRiskLevels' => $institutionRiskLevels,
            'institutionRiskLevelFiles' => $institutionRiskLevelFiles
        ]);
    }

    /**
     * @Route("/{locale}/institution/delete/{institutionId}", name="delete_institution", requirements={"institutionId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER_VIEW') or is_granted('ROLE_USER_INSTITUTION_VIEW_MY') or is_granted('ROLE_USER_INSTITUTION_VIEW_ALL') or is_granted('ROLE_ADMIN')")
     */
    public function deleteInstitution($institutionId)
    {
        /** @var Institution $institution */
        $institution = $this->getInstitutionRepository()->findOneBy(['id' => $institutionId]);
        $this->getInstitutionRepository()->delete($institution);

        $institutions = $this->getInstitutionRepository()->findAll();

        return $this->render('institution/list.twig', ['result' => $institutions]);
    }

    /**
     * @Route("/{locale}/institution/{institutionId}/file/risk-level/{riskLevelId}", name="institution_risk_level_file", requirements={"institutionId": "\d+", "riskLevelId": "\d+", "locale": "%app.locales%"})
     */
    public function getFileAction($institutionId, $riskLevelId)
    {
        /** @var InstitutionRiskLevel $riskLevel */
        $riskLevel = $this->getInstitutionRiskLevelRepository()->find($riskLevelId);
        if($riskLevel != null && $riskLevel->getInstitution()->getId() == $institutionId) {
            return new BinaryFileResponse($this->get('util.file_uploader')->getTargetDir().'/'.$riskLevel->getFile()->getFile());
        }

        throw new AccessDeniedHttpException();
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
     * @return InstitutionRiskLevelRepository
     */
    private function getInstitutionRiskLevelRepository() {

        return $this->get('doctrine_entity_repository.institution_risk_level');
    }

    /**
     * @return FileRepository
     */
    private function getFileRepository() {

        return $this->get('doctrine_entity_repository.file');
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

    /**
     * @return UserInstitutionRepository
     */
    private function getUserInstitutionRepository() {

        return $this->get('doctrine_entity_repository.user_institution');
    }
}