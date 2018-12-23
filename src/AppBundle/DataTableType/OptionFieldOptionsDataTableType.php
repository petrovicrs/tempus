<?php

namespace AppBundle\DataTableType;

use AppBundle\Entity\OptionField;
use AppBundle\Entity\OptionFieldOption;
use AppBundle\Util\HtmlBuilderHelper;
use Doctrine\ORM\QueryBuilder;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\DataTable;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;

/**
 * Class OptionFieldOptionsDataTableType
 *
 * @package AppBundle\DataTableType
 */
class OptionFieldOptionsDataTableType extends AbstractDataTableType {

    /**
     * @param DataTable $dataTable
     * @param array $typeOptions
     */
    public function configure(DataTable $dataTable, array $typeOptions) {
        $optionFieldId = isset($typeOptions['optionFieldId']) ? $typeOptions['optionFieldId'] : null;
        $dataTable
            ->add($this->getNameColumnName(), TextColumn::class, [
                'label' => 'datatable.option_field_option.name',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
            ])
            ->add('code', TextColumn::class, [
                'label' => 'datatable.option_field_option.code',
                'raw' => false,
                'className' => '',
                'visible' => true,
                'searchable' => true,
                'globalSearchable' => true,
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
                'data' => function (OptionFieldOption $option) {
                    return HtmlBuilderHelper::createInfoLinkSymbolHtml($this->generateRoute('option_field_option_view', [
                        'locale' => $this->getLocale(),
                        'optionId' => $option->getId(),
                        'optionFieldId' => $option->getOptionField()->getId()
                    ]));
                },
            ])
            ->add('edit_link', TextColumn::class, [
                'label' => 'msg.edit',
                'className' => 'text-center',
                'raw' => true,
                'data' => function (OptionFieldOption $option) {
                    return HtmlBuilderHelper::createEditLinkSymbolHtml($this->generateRoute('option_field_option_edit', [
                        'locale' => $this->getLocale(),
                        'optionId' => $option->getId(),
                        'optionFieldId' => $option->getOptionField()->getId()
                    ]));
                },
            ])
            ->createAdapter(ORMAdapter::class, [
                'entity' => OptionFieldOption::class,
                'query' => function (QueryBuilder $builder) use ($optionFieldId) {
                    $builder
                        ->select('o')
                        ->from(OptionFieldOption::class, 'o')
                        ->where('o.optionField = :optionFieldId')
                        ->setParameter(':optionFieldId', $optionFieldId)
                    ;
                },
                'criteria' => [
                    new SearchCriteriaProvider(),
                ],
            ]);
    }

}