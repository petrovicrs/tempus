<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\InstitutionRiskLevel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RiskLevelForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('riskLevelType', EntityType::class, [
                'class' => 'AppBundle:InstitutionRiskLevelType',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Risk Level Type'
            ])
            ->add('file', FileType::class, array(
                'label' => false,
                'attr'=>
                    array(
                        'class'=>'form-control btn btn-add btn-success')
            ));
//            ->add('manuallyUploadedFiles', CollectionType::class, array(
//                'entry_type' => RiskLevelManuallyUploadedForm::class,
//                'allow_add' => true,
//                'by_reference' => false,
//                'label' => false
//            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => InstitutionRiskLevel::class,
            'locale' => 'en',
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
