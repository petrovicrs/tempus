<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 29.08.17
 * Time: 23:43
 */

namespace AppBundle\Form;

use AppBundle\Entity\PartnersTeamMembers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnersTeamMembersForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('memberPosition', EntityType::class, [
                'class' => 'AppBundle:TeamMemberPositions',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('member', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName($options['locale']);
                }
            ])
            ->add('budget');
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
            'data_class' => PartnersTeamMembers::class,
        ]);

    }
}