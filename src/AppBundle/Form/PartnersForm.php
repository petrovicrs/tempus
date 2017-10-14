<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 29.08.17
 * Time: 23:43
 */

namespace AppBundle\Form;

use AppBundle\Entity\Partners;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnersForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution', EntityType::class, [
                'class' => 'AppBundle:Institution',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('partnerType', EntityType::class, [
                'class' => 'AppBundle:PartnerType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('projectCoordinator', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName($options['locale']);
                }
            ])
            ->add('legalRepresentative', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName($options['locale']);
                }
            ])
            ->add('isAssociatedPartner', CheckboxType::class, array('required' => false))
            ->add('budget')
            ->add('isWithoutTeam', CheckboxType::class, array('required' => false))
            ->add('allDepartments', CheckboxType::class, array('required' => false))
            ->add('teamMembers', CollectionType::class, array(
                'entry_type'   => PartnersTeamMembersForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('teamDepartments', EntityType::class, array(
                'class' => 'AppBundle:PartnersTeamDepartments',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'expanded' => true,
                'multiple' => true
            ));
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
            'data_class' => Partners::class,
        ]);

    }
}