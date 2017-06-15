<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('goals')
            ->add('nameOriginalLetter')
            ->add('acronym')
            ->add('programId')
            ->add('status')
            ->add('scope')
            ->add('applicationYear')
            ->add('referenceNumber')
            ->add('duration')
            ->add('endDatetime')
            ->add('startDatetime')
            ->add('extendedTime')
            ->add('grantAmount')
            ->add('coFinancingAmount')
            ->add('totalProjectValue')
            ->add('mark')
            ->add('markExplanation')
            ->add('submit', SubmitType::class, array('label' => 'Create'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Projects'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }


}
