<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\User;
use AppBundle\Helper\HtmlBuilderHelper;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\Column\MapColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Column\NumberColumn;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;

/**
 * Class UserDataTableType
 *
 * @package AppBundle\DataTableType
 */
class UserDataTableType extends AbstractDataTableType {

    /**
     * @param DataTable $dataTable
     * @param array $typeOptions
     */
    public function configure(DataTable $dataTable, array $typeOptions) {
        $dataTable
            ->add('email', TextColumn::class, [
                'label' => 'datatable.user.email',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('name', TextColumn::class, [
                'label' => 'datatable.user.name',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('surname', TextColumn::class, [
                'label' => 'datatable.user.surname',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('lastLogin', DateTimeColumn::class, [
                'label' => 'datatable.user.last_login',
                'format' => 'd.m.Y',
                'className' => 'tooltipster tooltipster-bottom',
                'nullValue' => '-',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('loginCount', NumberColumn::class, [
                'label' => 'datatable.user.login_count',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('enabled', BoolColumn::class, [
                'label' => 'datatable.user.enabled',
                'className' => 'text-center',
                'trueValue' => HtmlBuilderHelper::createSuccessSymbolHtml(1),
                'falseValue' => HtmlBuilderHelper::createDangerSymbolHtml(0),
                'nullValue' => '',
            ])
            ->add('view_link', TextColumn::class, [
                'label' => 'msg.view',
                'className' => 'text-center',
                'raw' => true,
                'data' => function (User $user) {
                    return HtmlBuilderHelper::createInfoLinkSymbolHtml($this->generateRoute('user_view', [
                        'locale' => $this->getLocale(),
                        'userId' => $user->getId(),
                    ]));
                },
            ])
            ->add('edit_link', TextColumn::class, [
                'label' => 'msg.edit',
                'className' => 'text-center',
                'raw' => true,
                'data' => function (User $user) {
                    return HtmlBuilderHelper::createEditLinkSymbolHtml($this->generateRoute('user_edit', [
                        'locale' => $this->getLocale(),
                        'userId' => $user->getId(),
                    ]));
                },
            ])
            ->addOrderBy('lastLogin', DataTable::SORT_DESCENDING)
            ->createAdapter(ORMAdapter::class, [
                'entity' => User::class,
                'criteria' => [
                    new SearchCriteriaProvider(),
                ],
            ]);
    }

}