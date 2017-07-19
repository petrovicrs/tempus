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
use AppBundle\Repository\InstitutionContactRepository;
use AppBundle\Repository\InstitutionRepository;
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
}