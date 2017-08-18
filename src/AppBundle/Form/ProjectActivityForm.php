<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\FieldOfExpertise;
use AppBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectActivityForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activity_title_sr')
            ->add('activity_title_en')
            ->add('activity_desc_en')
            ->add('activity_desc_sr')
            ->add('deliverable_title_sr')
            ->add('deliverable_title_en')
            ->add('deliverable_desc_en')
            ->add('deliverable_desc_sr')
            ->add('deliverable_date', DateType::class)
            ->add('activityType', EntityType::class, [
                'class' => 'AppBundle:ProjectActivityType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('activityStatus', EntityType::class, [
                'class' => 'AppBundle:ProjectActivityStatus',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('deliverableType', EntityType::class, [
                'class' => 'AppBundle:ProjectDeliverableType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('deliverableStatus', EntityType::class, [
                'class' => 'AppBundle:ProjectDeliverableStatus',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('activityTo', EntityType::class, [
                'class' => 'AppBundle:ProjectActivity',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('activityFrom', EntityType::class, [
                'class' => 'AppBundle:ProjectActivity',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('submit', SubmitType::class);
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
            'locale' => 'en'
        ]);

    }
}
