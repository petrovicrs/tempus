<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

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

//        $container->getParameter('security.role_hierarchy.roles');

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
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                    ],
                ],
                'first_options' => ['label' => 'form.user.password'],
                'second_options' => ['label' => 'form.user.password_confirmation'],
                'invalid_message' => 'form.user.password_mismatch',
            ])
            ->add('roles', ChoiceType::class, [
                'attr' => [
                    'class' => 'field-type-choice',
                ],
                'multiple' => true,
                'expanded' => true,
                'choices' => [
                    'form.user.roles.super_admin' => 'ROLE_SUPER_ADMIN',
                    'form.user.roles.admin' => 'ROLE_ADMIN',
                    'form.user.roles.report' => 'ROLE_REPORT',
                    'form.user.roles.lookup' => 'ROLE_LOOKUP',
                    'form.user.roles.mailing_list' => 'ROLE_MAILING_LIST',
                    'form.user.roles.persons_manager' => 'ROLE_PERSONS_MANAGER',
                    'form.user.roles.persons_read_only' => 'ROLE_PERSONS_READ_ONLY',
                    'form.user.roles.institutions_manager' => 'ROLE_INSTITUTIONS_MANAGER',
                    'form.user.roles.institutions_manager_read_only' => 'ROLE_INSTITUTIONS_READ_ONLY',
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