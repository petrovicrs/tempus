<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Reporting;
use AppBundle\Entity\ReportingQuestionsAndAnswers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportingForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'class'         => 'AppBundle\Entity\ReportingType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('reportingDate', DateType::class, [
                'required' => true
            ])
            ->add('reportingBy', CollectionType::class, [
                'entry_type'    => ReportingPersonForm::class,
                'allow_add'     => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label'        => false
            ])
//            ->add('questionsAndAnswers', CollectionType::class, [
//                'entry_type'    => ReportingQuestionsAndAnswersForm::class,
//                'allow_add'     => true,
//                'by_reference' => false,
//                'allow_delete' => true,
//                'label'        => false
//            ])
            ->add('commentsAndSuggestions', TextType::class)
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
            'data_class' => Reporting::class,
            'allow_extra_fields' => true,
        ]);
    }
}