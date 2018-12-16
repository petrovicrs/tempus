<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectStartForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        $builder->addEventSubscriber(new AddProjectActionSubscriber('actions', 'keyActions'));

        $builder
            ->add('programmes', EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('keyActions', EntityType::class, [
                'class' => 'AppBundle:ProjectKeyAction',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
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
