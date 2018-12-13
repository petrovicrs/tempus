<?php

namespace AppBundle\Form\User;

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
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.user.name',
                'attr' => [
                ],
            ])
            ->add('surname', TextType::class, [
                'label' => 'form.user.surname',
                'attr' => [
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.user.email',
                'attr' => [
                ],
            ])
            ->add('username', null, [
                'label' => 'form.user.username',
                'attr' => [
                ],
            ])
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
                ]
            ]);
            if (!$builder->getDisabled()) {
                $builder->add('submit', SubmitType::class, [
                    'label' => 'msg.save',
                    'attr' => [
                        'class' => 'btn btn-primary'
                    ]
                ]);
            }
    }

}