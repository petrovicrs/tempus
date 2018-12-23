<?php

namespace AppBundle\Form\OptionFields;

use AppBundle\Entity\OptionField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class OptionFieldForm
 *
 * @package AppBundle\Form\OptionFields
 */
class OptionFieldForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nameSr', TextType::class, [
                'label' => 'form.common.nameSr',
            ])
            ->add('nameEn', TextType::class, [
                'label' => 'form.common.nameEn',
            ])
            ->add('identifier', TextType::class, [
                'label' => 'form.option_field.identifier',
                'disabled' => $options['is_edit']
            ])
            ->add('acronym', TextType::class, [
                'label' => 'form.option_field.acronym',
                'required' => false
            ])
            ->add('code', TextType::class, [
                'label' => 'form.option_field.code',
                'required' => false
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'msg.isActive',
                'required' => false,
            ]);
        if (!$builder->getDisabled()) {
            $builder->add('submit', SubmitType::class, [
                'label' => 'msg.save',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => OptionField::class,
            'is_edit' => false
        ]);
    }

}