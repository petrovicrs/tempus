<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\UserGroup;
use AppBundle\Util\HtmlBuilderHelper;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;

/**
 * Class UserGroupDataTableType
 *
 * @package AppBundle\DataTableType
 */
class UserGroupDataTableType extends AbstractDataTableType {

    /**
     * @param DataTable $dataTable
     * @param array $typeOptions
     */
    public function configure(DataTable $dataTable, array $typeOptions) {
        $dataTable
            ->add($this->getNameColumnName(), TextColumn::class, [
                'label' => 'datatable.user_group.name',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('program', TextColumn::class, [
                'label' => 'datatable.user_group.program',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
                'data' => function (UserGroup $group) {
                    return $group->getProgram()->getName($this->getLocale());
                },
            ])
            ->add('isActive', BoolColumn::class, [
                'label' => 'datatable.user_group.isActive',
                'className' => 'text-center',
                'trueValue' => HtmlBuilderHelper::createSuccessSymbolHtml(1),
                'falseValue' => HtmlBuilderHelper::createDangerSymbolHtml(0),
                'nullValue' => '',
            ])
            ->add('view_link', TextColumn::class, [
                'label' => 'msg.view',
                'className' => 'text-center',
                'raw' => true,
                'data' => function (UserGroup $group) {
                    return HtmlBuilderHelper::createInfoLinkSymbolHtml($this->generateRoute('user_group_view', [
                        'locale' => $this->getLocale(),
                        'groupId' => $group->getId(),
                    ]));
                },
            ])
            ->add('edit_link', TextColumn::class, [
                'label' => 'msg.edit',
                'className' => 'text-center',
                'raw' => true,
                'data' => function (UserGroup $group) {
                    return HtmlBuilderHelper::createEditLinkSymbolHtml($this->generateRoute('user_group_edit', [
                        'locale' => $this->getLocale(),
                        'groupId' => $group->getId(),
                    ]));
                },
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => UserGroup::class,
                'query' => function (QueryBuilder $builder) {
                    $builder
                        ->select('u')
                        ->from(UserGroup::class, 'u');
                },
                'criteria' => [
                    new SearchCriteriaProvider(),
                ],
            ]);
    }

}