<?php

namespace AppBundle\Form\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class UserPermissionForm
 * @package AppBundle\Form\User
 */
class UserPermissionForm extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add(
                'create',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['create']])
            )
            ->add('view', CheckboxType::class, array('required' => false, 'attr' => ['checked' => $options['view']]))
            ->add(
                'delete',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['delete']])
            )
            ->add('edit', CheckboxType::class, array('required' => false, 'attr' => ['checked' => $options['edit']]))
            ->add(
                'projectCreate',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['projectCreate']])
            )
//            ->add('projectViewMy', CheckboxType::class, array('required' => false))
            ->add(
                'projectViewAll',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['projectViewAll']])
            )
//            ->add('projectEditMy', CheckboxType::class, array('required' => false))
            ->add(
                'projectEditAll',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['projectEditAll']])
            )
//            ->add('projectDeleteMy', CheckboxType::class, array('required' => false))
            ->add(
                'projectDeleteAll',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['projectDeleteAll']])
            )
            ->add(
                'institutionCreate',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['institutionCreate']])
            )
//            ->add('institutionViewMy', CheckboxType::class, array('required' => false))
            ->add(
                'institutionViewAll',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['institutionViewAll']])
            )
//            ->add('institutionDeleteMy', CheckboxType::class, array('required' => false))
            ->add(
                'institutionDeleteAll',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['institutionDeleteAll']])
            )
//            ->add('institutionEditMy', CheckboxType::class, array('required' => false))
            ->add(
                'institutionEditAll',
                CheckboxType::class,
                array('required' => false, 'attr' => ['checked' => $options['institutionEditAll']])
            )
            ->add(
                'existingProjectPermission',
                CollectionType::class,
                array(
                    'entry_type' => ExistingProjectPermissionForm::class,
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'label' => false,
                )
            )
            ->add(
                'existingInstitutionPermission',
                CollectionType::class,
                array(
                    'entry_type' => ExistingInstitutionPermissionForm::class,
                    'allow_add' => true,
                    'by_reference' => false,
                    'allow_delete' => true,
                    'label' => false,
                )
            )
            ->add('submit', SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'appbundle_project';
    }


    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            [
                'create' => false,
                'edit' => false,
                'delete' => false,
                'view' => false,
                'projectCreate' => false,
                'projectViewAll' => false,
                'projectEditAll' => false,
                'projectDeleteAll' => false,
                'institutionCreate' => false,
                'institutionViewAll' => false,
                'institutionEditAll' => false,
                'institutionDeleteAll' => false,
                'locale' => 'en',
                'data_class' => null,
            ]
        );

    }
}
