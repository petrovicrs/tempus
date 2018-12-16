<?php

namespace AppBundle\Form\UserForm;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\UserProgramAccess;
use AppBundle\Entity\UserProjectAccess;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserProjectProgrammePermissionForm
 *
 * @package AppBundle\Form\UserForm
 */
class UserProgramAccessForm extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('program', EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'required' => false,
                'choice_label' => 'name' . ucfirst($options['locale']),
                'label' => 'Program',
            ])
            ->add('hasAccess', ChoiceType::class, [
                'label' => 'Access',
                'choices'  => array(
                    'Allow access' => true,
                    'Deny access' => false,
                ),
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => UserProgramAccess::class,
            'locale' => 'en',
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
        return "user_program_access_form";
    }


}
