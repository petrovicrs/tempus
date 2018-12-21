<?php

namespace AppBundle\Form\UserForm;

use AppBundle\Entity\User;
use AppBundle\Entity\UserGroup;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
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
 * Class UserGroupForm
 *
 * @package AppBundle\Form\UserForm
 */
class UserGroupForm extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nameEn', TextType::class, [
                'label' => 'common.nameEn',
            ])
            ->add('nameSr', TextType::class, [
                'label' => 'common.nameSr',
            ])
            ->add('program', EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'label' => 'form.user_group.program',
                'attr' => [
                    'class' => 'jquery-select2-element'
                ]
            ])
            ->add('isActive', CheckboxType::class, [
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
            'data_class' => UserGroup::class,
            'locale' => 'en'
        ]);
    }

}