<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 13.08.17
 * Time: 22:13
 */

namespace AppBundle\Form;

use AppBundle\Entity\ReportingQuestionsAndAnswers;
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
            ->add('question' . ucfirst($options['locale']))
            ->add('answer' . ucfirst($options['locale']))
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
            'locale' => 'en',
            'data_class' => ReportingQuestionsAndAnswers::class
        ]);
    }
}