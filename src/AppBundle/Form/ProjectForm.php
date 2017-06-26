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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameEng', TextType::class)
            ->add('nameSrb', TextType::class)
            ->add('description', TextType::class)
            ->add('goals', TextType::class)
            ->add('nameOriginalLetter', TextType::class)
            ->add('acronym', TextType::class)
            ->add('program', EntityType::class, ['class' => 'AppBundle:Program', 'choice_label' => 'name' ])
            ->add('status', TextType::class)
            ->add('scope', TextType::class)
            ->add('applicationYear')
            ->add('referenceNumber', TextType::class)
            ->add('duration', TextType::class)
            ->add('endDatetime')
            ->add('startDatetime')
            ->add('extendedTime')
            ->add('grantAmount', TextType::class)
            ->add('coFinancingAmount', TextType::class)
            ->add('totalProjectValue', TextType::class)
            ->add('mark', TextType::class)
            ->add('markExplanation', TextType::class)
            ->add('submit', SubmitType::class, array('label' => $options['submit_button_label']));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Projects',
            'submit_button_label' => 'Create'
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
