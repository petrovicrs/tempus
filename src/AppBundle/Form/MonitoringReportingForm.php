<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 18:06
 */

namespace AppBundle\Form;


use AppBundle\Entity\MonitoringReporting;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MonitoringReportingForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('monitoringType', EntityType::class, [
                'class' => 'AppBundle:ReportingType',
                'choice_label'  => 'name' . ucfirst($options['locale'])
            ])
            ->add('monitoringDate', DateType::class)
            ->add('commentType', EntityType::class, [
                'class' => 'AppBundle:CommentType',
                'choice_label'  => 'name' . ucfirst($options['locale'])
            ])
            ->add('comment', TextareaType::class)
            ->add('submit', SubmitType::class, array('label_format' => 'Next'));
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
            'data_class' => MonitoringReporting::class,
        ]);

    }
}