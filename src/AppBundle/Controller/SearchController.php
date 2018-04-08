<?php

namespace AppBundle\Controller;

use AppBundle\Form\ProjectSearchForm;
use AppBundle\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SearchController extends AbstractController {


    /**
     * @Route("/{locale}/search/projects", name="search_projects", requirements={"locale": "%app.locales%"})
     */
    public function searchProjects(Request $request)
    {

        $projectResultsForm = $this->createForm(ProjectSearchForm::class, null, [
            'action' => $this->generateUrl('search_projects'),
            'method' => 'GET',
            'locale' => $request->getLocale()
        ]);

        $projectResultsForm->handleRequest($request);

        $results = [];
        if ($projectResultsForm->isValid()) {
            $data = $projectResultsForm->getData();

            $queryBuilder = $this->getProjectRepository()->createQueryBuilder('o');

            //project project query builder
            if(!is_null($data[ProjectSearchForm::ACRONYM])) {
                $queryBuilder->where('o.acronym LIKE :acronym')
                    ->setParameter('acronym', '%'.$data[ProjectSearchForm::ACRONYM].'%');
            }
            if(!is_null($data[ProjectSearchForm::TITLE])) {
                $queryBuilder->andWhere('o.nameEn LIKE :title OR o.nameSr LIKE :title')
                    ->setParameter('title', '%'.$data[ProjectSearchForm::TITLE].'%');
            }
            if(!is_null($data[ProjectSearchForm::REFERENCE_NUMBER])) {
                $queryBuilder->andWhere('o.projectNumber LIKE :referenceNumber')
                    ->setParameter('referenceNumber', '%'.$data[ProjectSearchForm::REFERENCE_NUMBER].'%');
            }
            if(!is_null($data[ProjectSearchForm::PROGRAMMES])) {
                $queryBuilder->andWhere('o.programmes = :programmes')
                    ->setParameter("programmes", $data[ProjectSearchForm::PROGRAMMES]);
            }
            if(!is_null($data[ProjectSearchForm::KEY_ACTIONS])) {
                $queryBuilder->andWhere('o.keyActions = :keyActions')
                    ->setParameter("keyActions", $data[ProjectSearchForm::KEY_ACTIONS]);
            }
            if(!is_null($data[ProjectSearchForm::ACTIONS])) {
                $queryBuilder->andWhere('o.actions = :actions')
                    ->setParameter("actions", $data[ProjectSearchForm::ACTIONS]);
            }
            if(!is_null($data[ProjectSearchForm::START_DATE_START])) {
                $queryBuilder->andWhere('o.startDatetime >= :startDateStart')
                    ->setParameter("startDateStart", $data[ProjectSearchForm::START_DATE_START]);
            }
            if(!is_null($data[ProjectSearchForm::START_DATE_END])) {
                $queryBuilder->andWhere('o.startDatetime <= :startDateEnd')
                    ->setParameter("startDateEnd", $data[ProjectSearchForm::START_DATE_END]);
            }
            if(!is_null($data[ProjectSearchForm::END_DATE_START])) {
                $queryBuilder->andWhere('o.endDatetime >= :endDateStart')
                    ->setParameter("endDateStart", $data[ProjectSearchForm::END_DATE_START]);
            }
            if(!is_null($data[ProjectSearchForm::END_DATE_END])) {
                $queryBuilder->andWhere('o.endDatetime <= :endDateEnd')
                    ->setParameter("endDateEnd", $data[ProjectSearchForm::END_DATE_END]);
            }

            if(!is_null($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION])
                || sizeof($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY]) != 0) {
                $queryBuilder->leftJoin(
                    'AppBundle\Entity\ProjectPartnerOrganisation',
                    'ppo',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'o = ppo.project'
                );
            }

            if(!is_null($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION])) {
                $queryBuilder->andWhere('ppo.organisation = :partnerOrganizationInstitution')
                    ->setParameter("partnerOrganizationInstitution", $data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION]);
            }

            if(sizeof($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY]) != 0) {
                $queryBuilder->leftJoin(
                    'AppBundle\Entity\Institution',
                    'inst',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'ppo.organisation = inst'
                )->leftJoin(
                    'AppBundle\Entity\InstitutionAddress',
                    'inst_addr',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'inst = inst_addr.institution'
                )->andWhere('inst_addr.country IN (:partnerOrganizationInstitutionCountry)')
                    ->setParameter("partnerOrganizationInstitutionCountry", $data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY]);
            }


            if(!is_null($data[ProjectSearchForm::PARTNER_ORGANIZATION_PERSON])) {
                $queryBuilder->leftJoin(
                    'AppBundle\Entity\ProjectContactPerson',
                    'projectContactPerson',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'o = projectContactPerson.project'
                )->leftJoin(
                    'AppBundle\Entity\Person',
                    'person3',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'person3 = projectContactPerson.person'
                )->leftJoin(
                    'AppBundle\Entity\ProjectPartners',
                    'projectPartners',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'o = projectPartners.project'
                )->leftJoin(
                    'AppBundle\Entity\Partners',
                    'partners',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'projectPartners = partners.projectPartners'
                )->leftJoin(
                    'AppBundle\Entity\Person',
                    'person',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'person = partners.projectCoordinator'
                )->leftJoin(
                    'AppBundle\Entity\Person',
                    'person2',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'person2 = partners.legalRepresentative'
                )->andWhere(
                    'CONCAT(CONCAT(person.firstNameEn, \' \'),  person.lastNameEn) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person.firstNameSr, \' \'),  person.lastNameSr) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person.firstNameOriginalLetter, \' \'),  person.lastNameOriginalLetter) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person2.firstNameEn, \' \'),  person2.lastNameEn) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person2.firstNameSr, \' \'),  person2.lastNameSr) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person2.firstNameOriginalLetter, \' \'),  person2.lastNameOriginalLetter) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person3.firstNameSr, \' \'),  person3.lastNameSr) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person3.firstNameSr, \' \'),  person3.lastNameSr) LIKE :partnerOrganizationPerson OR
                    CONCAT(CONCAT(person2.firstNameOriginalLetter, \' \'),  person2.lastNameOriginalLetter) LIKE :partnerOrganizationPerson')
                    ->setParameter('partnerOrganizationPerson', '%'.$data[ProjectSearchForm::PARTNER_ORGANIZATION_PERSON].'%');;
            }




            /** DELIVERABLES */
            if(!is_null($data[ProjectSearchForm::DELIVERABLE_TYPE]) ||
                !is_null($data[ProjectSearchForm::DELIVERABLE_STATUS]) ||
                !is_null($data[ProjectSearchForm::DELIVERABLE_TITLE])) {
                $queryBuilder->leftJoin(
                    'AppBundle\Entity\ProjectDeliverablesActivities',
                    'projectDeliverablesActivities',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'o = projectDeliverablesActivities.project'
                )->leftJoin(
                    'AppBundle\Entity\ProjectDeliverable',
                    'projectDeliverable',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'projectDeliverable.projectDeliverablesActivities = projectDeliverablesActivities'
                );
            }

            if(!is_null($data[ProjectSearchForm::DELIVERABLE_TYPE])){
                $queryBuilder->leftJoin(
                    'AppBundle\Entity\ProjectDeliverableType',
                    'projectDeliverableType',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'projectDeliverable.deliverableType = projectDeliverableType'
                )->andWhere(
                    'projectDeliverableType = :projectDeliverableType')
                    ->setParameter("projectDeliverableType", $data[ProjectSearchForm::DELIVERABLE_TYPE]);
            }

            if(!is_null($data[ProjectSearchForm::DELIVERABLE_STATUS])){
                $queryBuilder->andWhere(
                    'projectDeliverable.deliverableStatus = :deliverableStatus')
                    ->setParameter("deliverableStatus", $data[ProjectSearchForm::DELIVERABLE_STATUS]);
            }
            if(!is_null($data[ProjectSearchForm::DELIVERABLE_TITLE])){
                $queryBuilder->andWhere(
                    'projectDeliverable.titleEn LIKE :deliverableType OR projectDeliverable.titleSr LIKE :deliverableType')
                    ->setParameter("deliverableType", '%'.$data[ProjectSearchForm::DELIVERABLE_TITLE].'%');
            }




            /** SUBJECT AREA */
            if(!is_null($data[ProjectSearchForm::SUBJECT_AREA])) {
                $queryBuilder->leftJoin(
                    'AppBundle\Entity\ProjectSubjectArea',
                    'projectSubjectArea',
                    \Doctrine\ORM\Query\Expr\Join::WITH,
                    'o = projectSubjectArea.project'
                )->andWhere( 'projectSubjectArea.areaType= :subjectArea')
                    ->setParameter("subjectArea", $data[ProjectSearchForm::SUBJECT_AREA]);
            }



            $results = $queryBuilder->getQuery()->getResult();
        }

        return $this->render('search/search-projects.twig', [
            'my_form' => $projectResultsForm->createView(),
            'results' => $results
        ]);
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }

}