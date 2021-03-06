<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\ExistingInstitutionPermission;
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

class ExistingInstitutionPermissionForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('existingInstitutionView', CheckboxType::class, array('required' => false))
            ->add('existingInstitutionEdit', CheckboxType::class, array('required' => false))
            ->add('existingInstitutionDelete', CheckboxType::class, array('required' => false))
            ->add('existingInstitutionExport', CheckboxType::class, array('required' => false))
            ->add('institution', EntityType::class, [
                'class' => 'AppBundle:Institution',
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
            'data_class' => ExistingInstitutionPermission::class,
        ]);

    }
}
