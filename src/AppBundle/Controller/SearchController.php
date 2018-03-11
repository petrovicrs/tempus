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

            if(!is_null($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION])
                || !is_null($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY])) {
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

            if(!is_null($data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY])) {
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
                )->andWhere('inst_addr.country = :partnerOrganizationInstitutionCountry')
                    ->setParameter("partnerOrganizationInstitutionCountry", $data[ProjectSearchForm::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY]);
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