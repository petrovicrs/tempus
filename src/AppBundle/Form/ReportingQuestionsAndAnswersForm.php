<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 13.08.17
 * Time: 22:13
 */

namespace AppBundle\Form;

use AppBundle\Entity\ReportingQuestionsAndAnswers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportingQuestionsAndAnswersForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('questions', EntityType::class, array(
                'class'   => 'AppBundle\Entity\Questions',
                'label' => false,
                'choice_label'  => function($value, $key) use ($options){
                    return $value->getQuestion($options['locale']);
                }
            ))
            ->add('answer', TextType::class);
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
            'data_class' => ReportingQuestionsAndAnswers::class
        ]);
    }
}