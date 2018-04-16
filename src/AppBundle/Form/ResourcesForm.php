<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Resources;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResourcesForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resourceType', EntityType::class, [
                'class'         => 'AppBundle\Entity\ResourceType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('keywords', TextType::class)
            ->add('isPublic', CheckboxType::class, [
//                'label' => 'Public?',
                'required' => false
            ])
            ->add('titleEn')
            ->add('titleSr', TextType::class, array('required' => false))
            ->add('descriptionEn')
            ->add('descriptionSr', TextType::class, array('required' => false))
            ->add('abstract');
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
            'data_class' => Resources::class
        ]);
    }
}