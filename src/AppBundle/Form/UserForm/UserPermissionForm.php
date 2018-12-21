<?php

namespace AppBundle\Form\UserForm;

use AdamQuaile\Bundle\FieldsetBundle\Form\FieldsetType;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserPermissionForm
 *
 * @package AppBundle\Form\User
 */
class UserPermissionForm extends AbstractType {

    /** @var string */
    private $locale;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->locale = $options['locale'];
        $builder
            ->add('programsAccessAllowedFieldset', FieldsetType::class, [
                'label' => false,
                'legend' => 'form.user.access.programs',
                'attr' => [
                    'class' => 'collection-element'
                ],
                'fields' => function(FormBuilderInterface $builder) {
                    $builder
                        ->add('programsAccess', CollectionType::class, [
                            'entry_type'  => UserProgramAccessForm::class,
                            'entry_options'  => [
                                'locale' => $this->locale
                            ],
                            'allow_add'    => true,
                            'label' => false,
                            'allow_delete' => true,
                            'attr' => [
                                'class' => 'jquery-collection-element',
                            ],
                        ])
                    ;
                }
            ])
            ->add('projectsAccessAllowedFieldset', FieldsetType::class, [
                'label' => false,
                'legend' => 'form.user.access.projects',
                'attr' => [
                    'class' => 'collection-element'
                ],
                'fields' => function(FormBuilderInterface $builder) {
                    $builder
                        ->add('projectsAccess', CollectionType::class, [
                            'entry_type'  => UserProjectAccessForm::class,
                            'entry_options'  => [
                                'locale' => $this->locale
                            ],
                            'allow_add'    => true,
                            'label' => false,
                            'allow_delete' => true,
                            'attr' => [
                                'class' => 'jquery-collection-element',
                            ],
                        ])
                    ;
                }
            ])
        ;
        if (!$builder->getDisabled()) {
            $builder->add('submit', SubmitType::class, [
                'label' => 'msg.save',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => User::class,
            'locale' => 'en'
        ]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix() {
        return "user_permission_form";
    }

}
