<?php

namespace AppBundle\Form\UserForm;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class UserForm
 *
 * @package AppBundle\Form
 */
class UserForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $newUser = isset($options['new_user']) && $options['new_user'];
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.user.name',
            ])
            ->add('surname', TextType::class, [
                'label' => 'form.user.surname',
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.user.email',
                'disabled' => !$newUser,
            ])
            ->add('username', TextType::class, [
                'label' => 'form.user.username',
                'disabled' => !$newUser,
            ]);
        if ($newUser) {
            $builder
                ->add('plainPassword', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'constraints' => [
                        new NotBlank(),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'form.user.surname'//"Your password must be at least 6 characters long"
                        ])
                    ],
                    'first_options' => ['label' => 'form.user.password'],
                    'second_options' => ['label' => 'form.user.password_confirmation'],
                    'invalid_message' => 'form.user.password_mismatch',
                ]);
        }
        $builder
            ->add('roles', ChoiceType::class, [
                'label' => 'form.user.roles',
                'attr' => [
                    'class' => 'field-type-choice',
                ],
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'form.user.role.super_admin' => 'ROLE_SUPER_ADMIN',
                    'form.user.role.admin' => 'ROLE_ADMIN',
                    'form.user.role.normal' => 'ROLE_NORMAL',
                    'form.user.role.minimal' => 'ROLE_MINIMAL',
                    'form.user.role.custom' => 'ROLE_CUSTOM',
                ],
            ])
            ->add('enabled', CheckboxType::class, [
                'label' => 'form.user.enabled',
                'attr' => [
                    'checked' => 'checked'
                ]
            ]);
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
            'new_user' => false,
        ]);
    }

}