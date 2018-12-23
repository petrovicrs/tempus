<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\OptionField;
use AppBundle\Util\HtmlBuilderHelper;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;

/**
 * Class OptionFieldsDataTableType
 *
 * @package AppBundle\DataTableType
 */
class OptionFieldsDataTableType extends AbstractDataTableType {

    /**
     * @param DataTable $dataTable
     * @param array $typeOptions
     */
    public function configure(DataTable $dataTable, array $typeOptions) {
        $dataTable
            ->add($this->getNameColumnName(), TextColumn::class, [
                'label' => 'datatable.option_field.name',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('identifier', TextColumn::class, [
                'label' => 'datatable.option_field.identifier',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('acronym', TextColumn::class, [
                'label' => 'datatable.option_field.acronym',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('code', TextColumn::class, [
                'label' => 'datatable.option_field.code',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('options_count', TextColumn::class, [
                'label' => 'datatable.option_field.option_count',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
                'data' => function(OptionField $option) {
                    return $option->getOptions()->count();
                },
            ])
            ->add('isActive', BoolColumn::class, [
                'label' => 'msg.isActive',
                'className' => 'text-center',
                'trueValue' => HtmlBuilderHelper::createSuccessSymbolHtml(1),
                'falseValue' => HtmlBuilderHelper::createDangerSymbolHtml(0),
                'nullValue' => '',
            ])
            ->add('view_link', TextColumn::class, [
                'label' => 'msg.view',
                'className' => 'text-center',
                'raw' => true,
                'data' => function (OptionField $option) {
                    return HtmlBuilderHelper::createInfoLinkSymbolHtml($this->generateRoute('option_field_options_list', [
                        'locale' => $this->getLocale(),
                        'optionFieldId' => $option->getId(),
                    ]));
                },
            ]);
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $dataTable
                ->add('edit_link', TextColumn::class, [
                    'label' => 'msg.edit',
                    'className' => 'text-center',
                    'raw' => true,
                    'data' => function (OptionField $option) {
                        return HtmlBuilderHelper::createEditLinkSymbolHtml($this->generateRoute('option_field_edit', [
                            'locale' => $this->getLocale(),
                            'optionFieldId' => $option->getId(),
                        ]));
                    },
                ]);
        }
        $dataTable
            ->createAdapter(ORMAdapter::class, [
                'entity' => OptionField::class,
                'criteria' => [
                    new SearchCriteriaProvider(),
                ],
            ]);
    }

}