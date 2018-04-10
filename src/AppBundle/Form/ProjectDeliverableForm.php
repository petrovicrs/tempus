<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\ProjectDeliverable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectDeliverableForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleSr',TextType::class, array('required' => false))
            ->add('titleEn')
            ->add('descEn', TextType::class, array('required' => false))
            ->add('descSr', TextType::class, array('required' => false))
            ->add('date', DateType::class)
            ->add('deliverableType', EntityType::class, [
                'class' => 'AppBundle:ProjectDeliverableType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('deliverableStatus', EntityType::class, [
                'class' => 'AppBundle:ProjectDeliverableStatus',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ]);
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
            'data_class' => ProjectDeliverable::class,
        ]);

    }
}
