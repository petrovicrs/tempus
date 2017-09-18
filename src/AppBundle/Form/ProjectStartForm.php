<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectStartForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('programmes', EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('keyActions', EntityType::class, [
                'class' => 'AppBundle:ProjectKeyAction',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'data' => 2
            ])
            ->add('actions', EntityType::class, [
                'class' => 'AppBundle:ProjectAction',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('calls', EntityType::class, [
                'class' => 'AppBundle:ProjectCall',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('rounds', EntityType::class, [
                'class' => 'AppBundle:ProjectRound',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('submit', SubmitType::class, array('label_format' => 'Submit'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'locale' => 'en'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }
}
