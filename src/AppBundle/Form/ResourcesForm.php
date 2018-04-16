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
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('abstract')
            ->add('authors')
            ->add('file', FileType::class, array(
                'label' => false,
                'file_path' => $options['file_path'],
                'file_name' => $options['file_name'],
                'attr' =>
                    array(
                        'class' => 'form-control btn btn-add btn-success'
                    ),
                'mapped' => false,
                'auto_initialize' => false,
                'required' => false
            ));
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
            'file_path' => '',
            'file_name' => '',
            'data_class' => Resources::class,
            'auto_initialize' => false
        ]);
    }
}