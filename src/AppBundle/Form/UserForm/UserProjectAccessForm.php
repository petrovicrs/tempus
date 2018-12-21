<?php

namespace AppBundle\Form\UserForm;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\UserProjectAccess;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserProjectPermissionForm
 *
 * @package AppBundle\Form\UserForm
 */
class UserProjectAccessForm extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('project', EntityType::class, [
                'class' => 'AppBundle:Project',
                'required' => false,
                'choice_label' => 'name' . ucfirst($options['locale']),
                'label' => 'form.user.access.project',
            ])
            ->add('hasAccess', ChoiceType::class, [
                'label' => 'Access',
                'choices'  => array(
                    'form.user.access.allow' => true,
                    'form.user.access.deny' => false,
                ),
            ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => UserProjectAccess::class,
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
        return "user_project_access_form";
    }
}
