<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Util\HtmlBuilderHelper;
use AppBundle\Repository\ProjectProgram;
use Omines\DataTablesBundle\Adapter\ArrayAdapter;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\Column\MapColumn;
use Omines\DataTablesBundle\Column\TextColumn;

/**
 * Class ProjectsProgramDataTableType
 *
 * @package AppBundle\DataTableType
 */
class ProjectsProgramDataTableType extends AbstractDataTableType {
    /**
     * @param DataTable $dataTable
     * @param array $typeOptions
     */
    public function configure(DataTable $dataTable, array $typeOptions) {
        $dataTable
            ->add('name', TextColumn::class, [
                'label' => 'datatable.project.program.name',
                'className' => '',
                'raw' => true,
                'data' => function ($program) {
                    $prefix = '';
                    if ($program['level']) {
                        $prefix = str_repeat('&emsp;', $program['level']) . '<span class="fa fa-long-arrow-right"></span>  ';
                    }

                    return $prefix . $program[$this->getNameColumnName()];
                },
            ])
            ->add('program_type', MapColumn::class, [
                'label' => 'datatable.project.program.type',
                'raw' => false,
                'map' => [
                    ProjectProgramme::TYPE_UNKNOWN => ' - ',
                    ProjectProgramme::TYPE_PROGRAM => $this->translate('form.project.form.type.program'),
                    ProjectProgramme::TYPE_SUBPROGRAM => $this->translate('form.project.form.type.subprogram'),
                ],
            ])
            ->add('is_active', MapColumn::class, [
                'label' => 'datatable.project.program.isActive',
                'className' => 'text-center',
                'raw' => true,
                'map' => [
                    true => HtmlBuilderHelper::createSuccessSymbolHtml(1),
                    false => HtmlBuilderHelper::createDangerSymbolHtml(0),
                ]
            ])
            ->add('view_link', TextColumn::class, [
                'label' => 'msg.view',
                'className' => 'text-center',
                'raw' => true,
                'data' => function ($program) {
                    return HtmlBuilderHelper::createInfoLinkSymbolHtml($this->generateRoute('project_programs_view', [
                        'locale' => $this->getLocale(),
                        'programId' => $program['id'],
                    ]));
                },
            ])
            ->add('edit_link', TextColumn::class, [
                'label' => 'msg.edit',
                'className' => 'text-center',
                'raw' => true,
                'data' => function ($program) {
                    return HtmlBuilderHelper::createEditLinkSymbolHtml($this->generateRoute('project_programs_edit', [
                        'locale' => $this->getLocale(),
                        'programId' => $program['id'],
                    ]));
                },
            ])
//            ->add('delete_link', TextColumn::class, [
//                'label' => 'msg.delete',
//                'className' => 'text-center',
//                'raw' => true,
//                'data' => function ($program) {
//                    return HtmlBuilderHelper::createDeleteLinkSymbolHtml($this->generateRoute('project_programs_delete', [
//                        'locale' => $this->getLocale(),
//                        'programId' => $program['id'],
//                    ]));
//                },
//            ])
            ->createAdapter(ArrayAdapter::class, $this->getPrograms());
    }

    /**
     * Get project programs
     */
    private function getPrograms() {
        /** @var ProjectProgram  $repo */
        $repo = $this->container->get('doctrine_entity_repository.project_programs');
        /** @var ProjectProgramme[] $programs */
        $programs = $repo->createQueryBuilder('p')->where('p.parent IS NULL')->getQuery()->execute();
        $result = [];
        $currentLevel = 0;
        if (is_array($programs) && (bool)count($programs)) {
            $this->mapResult($programs, $result, $currentLevel);
        }
        return $result;
    }

    /**
     * @param array $programs
     * @param array $result
     * @param $currentLevel
     */
    private function mapResult(array $programs, &$result, &$currentLevel) {
        foreach ($programs as $program) {
            /** @var ProjectProgramme $program */
            $result[] = $this->programToArray($program, $currentLevel);
            if ($program->getChildren()->count()) {
                $childrenLevel = $currentLevel;
                $childrenLevel++;
                $this->mapResult($program->getChildren()->toArray(), $result, $childrenLevel);
            }
        }
    }

    private function programToArray(ProjectProgramme $programme, $level) {
        $result = [];
        $result['id'] = $programme->getId();
        $result['level'] = $level;
        $result['name_en'] = $programme->getNameEn();
        $result['name_sr'] = $programme->getNameSr();
        $result['name_lat'] = $programme->getNameLat();
        $result['program_type'] = $programme->getProgramType();
        $result['is_active'] = $programme->getIsActive();
        return $result;
    }

    /**
     * Return common name column
     *
     * @return string
     */
    protected function getNameColumnName() {
        $nameColumn = 'name_en';
        if ($this->getLocale() === 'sr') {
            $nameColumn = 'name_sr';
        } elseif ($this->getLocale() === 'lat') {
            $nameColumn = 'name_lat';
        }
        return $nameColumn;
    }

}