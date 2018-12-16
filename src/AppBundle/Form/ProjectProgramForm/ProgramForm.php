<?php

namespace AppBundle\Form\ProjectProgramForm;

use AppBundle\Entity\ProjectProgramme;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserForm
 *
 * @package AppBundle\Form
 */
class ProgramForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('programType', ChoiceType::class, [
                'label' => 'form.project.form.type',
                'multiple' => false,
                'choices' => [
                    'form.project.form.type.program' => ProjectProgramme::TYPE_PROGRAM,
                    'form.project.form.type.subprogram' => ProjectProgramme::TYPE_SUBPROGRAM,
                ],
            ])
            ->add('parent', EntityType::class, [
                'label' => 'form.project.form.parent',
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'empty_data'  => null,
                'required' => false,
            ])
            ->add('nameSr', TextType::class, [
                'label' => 'form.project.form.nameSr',
            ])
            ->add('nameEn', TextType::class, [
                'label' => 'form.project.form.nameEn',
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'form.project.form.isActive',
                'required' => false
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
            'data_class' => ProjectProgramme::class,
            'locale' => 'en'
        ]);
    }

}