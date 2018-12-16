<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Helper\HtmlBuilderHelper;
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
                    ProjectProgramme::TYPE_PROGRAM => $this->translate('datatable.project.program.type.program'),
                    ProjectProgramme::TYPE_SUBPROGRAM => $this->translate('datatable.project.program.type.subprogram'),
                ],
            ])
            ->add('is_active', BoolColumn::class, [
                'label' => 'datatable.project.program.isActive',
                'className' => 'text-center',
                'trueValue' => HtmlBuilderHelper::createSuccessSymbolHtml(1),
                'falseValue' => HtmlBuilderHelper::createDangerSymbolHtml(0),
                'nullValue' => '',
            ])
            ->add('created_at', TextColumn::class, [
                'label' => 'msg.createdAt',
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
     * @return string
     */
    private function getNameColumnName() {
        $result = 'name_en';
        if ($this->getLocale() == "sr") {
            $result = 'name_sr';
        }
        return $result;
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
        foreach ($programs as $program) {
            $level = -1;
            $this->mapResult($program, $result, $level);
        }
        return $result;
    }

    /**
     * @param ProjectProgramme $program
     * @param array $result
     * @param int $level
     */
    private function mapResult(ProjectProgramme $program, &$result, &$level) {
        $level++;
        $oldLevel = $level;
        $result[] = $this->programToArray($program, $level);
        foreach ($program->getChildren() as $child) {
            $this->mapResult($child, $result, $level);
        }
        $level = $oldLevel;
    }

    private function programToArray(ProjectProgramme $programme, $level) {
        $result = [];
        $result['id'] = $programme->getId();
        $result['level'] = $level;
        $result['name_en'] = $programme->getNameEn();
        $result['name_sr'] = $programme->getNameSr();
        $result['program_type'] = $programme->getProgramType();
        $result['is_active'] = $programme->getIsActive();
        $result['created_at'] = $programme->getCreatedAt()->format('d.m.Y');
        return $result;
    }

}