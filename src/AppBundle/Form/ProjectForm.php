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
            ->add('nameEng', TextType::class, ['label_format' => 'Name English'])
            ->add('nameSrb', TextType::class, ['label_format' => 'Name Serbian'])
            ->add('description', TextType::class, ['label_format' => 'Description'])
            ->add('goals', TextType::class, ['label_format' => 'Goals'])
            ->add('nameOriginalLetter', TextType::class, ['label_format' => 'Name Original Letter'])
            ->add('acronym', TextType::class, ['label_format' => 'Acronym'])
            ->add('program', EntityType::class, ['class' => 'AppBundle:Program', 'choice_label' => 'name', 'label_format' => 'Program'])
            ->add('status', TextType::class, ['label_format' => 'Status'])
            ->add('scope', TextType::class, ['label_format' => 'Scope'])
            ->add('applicationYear', null, ['label_format' => 'Application Year'])
            ->add('referenceNumber', TextType::class, ['label_format' => 'Reference Number'])
            ->add('duration', TextType::class, ['label_format' => 'Duration'])
            ->add('endDatetime', null, ['label_format' => 'End Datetime'])
            ->add('startDatetime', null, ['label_format' => 'Start Datetime'])
            ->add('extendedTime', null, ['label_format' => 'Extended Time'])
            ->add('grantAmount', TextType::class, ['label_format' => 'Grant Amount'])
            ->add('coFinancingAmount', TextType::class, ['label_format' => 'coFinancing Amount'])
            ->add('totalProjectValue', TextType::class, ['label_format' => 'Total Project Value'])
            ->add('mark', TextType::class, ['label_format' => 'Mark'])
            ->add('markExplanation', TextType::class, ['label_format' => 'Mark Explanation'])
            ->add('submit', SubmitType::class, array('label_format' => 'Submit'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Project',
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
