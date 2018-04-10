<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\ProjectActivity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectActivityForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titleSr',TextType::class, array('required' => false))
            ->add('titleEn')
            ->add('descEn',TextType::class, array('required' => false))
            ->add('descSr',TextType::class, array('required' => false))
            ->add('activityType', EntityType::class, [
                'class' => 'AppBundle:ProjectActivityType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('activityStatus', EntityType::class, [
                'class' => 'AppBundle:ProjectActivityStatus',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('activityTo', EntityType::class, [
                'class' => 'AppBundle:Institution',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('activityFrom', EntityType::class, [
                'class' => 'AppBundle:Institution',
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
            'data_class' => ProjectActivity::class
        ]);

    }
}
