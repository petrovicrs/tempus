<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Equipment;
use AppBundle\Entity\Results;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EquipmentForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution', EntityType::class, [
                'class'         => 'AppBundle\Entity\Institution',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('model')
            ->add('equipmentType', EntityType::class, [
                'class'         => 'AppBundle\Entity\EquipmentType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('quantity')
            ->add('purchaseDate', DateType::class, ['label_format' => 'Purchase Date'])
            ->add('inventoryNumber')
            ->add('titleEn',TextType::class, array('required' => false))
            ->add('titleSr',TextType::class, array('required' => false))
            ->add('descriptionEn',TextType::class, array('required' => false))
            ->add('descriptionSr',TextType::class, array('required' => false))
            ->add('locationSr',TextType::class, array('required' => false))
            ->add('locationEn',TextType::class, array('required' => false));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'locale' => 'en',
            'data_class' => Equipment::class
        ]);
    }
}