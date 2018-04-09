<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\InstitutionRiskLevel;
use AppBundle\FormType\FileTypeExtension;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BaseType;
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
            ->add('riskLevelId', HiddenType::class)
            ->add('riskLevelType', EntityType::class, [
                'class' => 'AppBundle:InstitutionRiskLevelType',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Please choose',
            ])
            ->add('file', FileType::class, array(
                'label' => false,
                'file_path' => $options['file_path'],
                'file_name' => $options['file_name'],
                'attr' =>
                    array(
                        'class' => 'form-control btn btn-add btn-success'
                    )
            ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
//            'data_class' => InstitutionRiskLevel::class,
            'locale' => 'en',
            'file_path' => '',
            'file_name' => '',
            'auto_initialize' => false
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
