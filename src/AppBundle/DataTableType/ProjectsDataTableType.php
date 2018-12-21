<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectCall;
use AppBundle\Entity\ProjectKeyAction;
use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\ProjectRound;
use AppBundle\Util\HtmlBuilderHelper;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\Column\MapColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;

/**
 * Class ProjectsDataTableType
 *
 * @package AppBundle\DataTableType
 */
class ProjectsDataTableType extends AbstractDataTableType {

    /**
     * @param DataTable $dataTable
     * @param array $typeOptions
     */
    public function configure(DataTable $dataTable, array $typeOptions) {
        $dataTable
            ->add('nameEn', TextColumn::class, [
                'label' => 'nameEn',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('acronym', TextColumn::class, [
                'label' => 'acronym',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('projectNumber', TextColumn::class, [
                'label' => 'projectNumber',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('programmes', TextColumn::class, [
                'label' => 'programmes',
                'data' => function (Project $project) {
                    /** @var ProjectProgramme $programme */
                    $programme = $project->getProgrammes();
                    return $programme->getName($this->getLocale());
                },
            ])
            ->add('actions', TextColumn::class, [
                'label' => 'actions',
                'data' => function (Project $project) {
                    /** @var ProjectKeyAction $action */
                    $action = $project->getCalls();
                    return $action->getName($this->getLocale());
                },
            ])
            ->add('keyActions', TextColumn::class, [
                'label' => 'keyActions',
                'data' => function (Project $project) {
                    /** @var ProjectKeyAction $action */
                    $action = $project->getCalls();
                    return $action->getName($this->getLocale());
                },
            ])
            ->add('calls', TextColumn::class, [
                'label' => 'calls',
                'raw' => true,
                'data' => function (Project $project) {
                    /** @var ProjectCall $calls */
                    $calls = $project->getCalls();
                    return $calls->getName($this->getLocale());
                },
            ])
            ->add('rounds', TextColumn::class, [
                'label' => 'rounds',
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
                'raw' => true,
                'data' => function (Project $project) {
                    /** @var ProjectRound $round */
                    $round = $project->getRounds();
                    return $round->getName($this->getLocale());
                },
            ])
            ->add('onGoing', MapColumn::class, [
                'label' => 'onGoing',
                'className' => 'text-center',
                'raw' => true,
                'default' => '',
                'map' => [
                    0 => HtmlBuilderHelper::createDangerSymbolHtml(0),
                    1 => HtmlBuilderHelper::createSuccessSymbolHtml(1),
                ],
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => Project::class,
                'criteria' => [
                    new SearchCriteriaProvider(),
                ],
            ]);
    }

}