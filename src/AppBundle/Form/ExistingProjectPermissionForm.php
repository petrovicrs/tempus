<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\ExistingProjectPermission;
use AppBundle\Entity\FieldOfExpertise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ExistingProjectPermissionForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('existingProjectView', CheckboxType::class, array('required' => false))
            ->add('existingProjectEdit', CheckboxType::class, array('required' => false))
            ->add('existingProjectDelete', CheckboxType::class, array('required' => false))
            ->add('existingProjectExport', CheckboxType::class, array('required' => false))
            ->add('project', EntityType::class, [
                'class' => 'AppBundle:Project',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('submit', SubmitType::class);
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
            'data_class' => ExistingProjectPermission::class,
        ]);

    }
}
