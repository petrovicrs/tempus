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

class ProjectKa2Form extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('programmes', EntityType::class, [
//                'class' => 'AppBundle:ProjectProgramme',
//                'choice_label' => 'name' . ucfirst($options['locale'])
//            ])
//            ->add('keyActions', EntityType::class, [
//                'class' => 'AppBundle:ProjectKeyAction',
//                'choice_label' => 'name' . ucfirst($options['locale']),
//                'data' => 2
//            ])
//            ->add('actions', EntityType::class, [
//                'class' => 'AppBundle:ProjectAction',
//                'choice_label' => 'name' . ucfirst($options['locale'])
//            ])
            ->add('types', EntityType::class, [
                'class' => 'AppBundle:ProjectType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
//            ->add('calls', EntityType::class, [
//                'class' => 'AppBundle:ProjectCall',
//                'choice_label' => 'name' . ucfirst($options['locale'])
//            ])
//            ->add('rounds', EntityType::class, [
//                'class' => 'AppBundle:ProjectRound',
//                'choice_label' => 'name' . ucfirst($options['locale'])
//            ])
            ->add('nameEn', TextType::class)
            ->add('nameSr', TextType::class)
            ->add('nameOriginalLetter', TextType::class)
            ->add('acronym', TextType::class)
            ->add('endDatetime', DateType::class)
            ->add('startDatetime', DateType::class)
            ->add('durationMonths', TextType::class)
            ->add('extendedUntil', DateType::class)
            ->add('audited', CheckboxType::class, array('required' => false))
            ->add('applicationYear', TextType::class)
            ->add('projectNumber', TextType::class)
            ->add('website', TextType::class)
            ->add('projectGrant', TextType::class)
            ->add('cofinancing', TextType::class)
            ->add('total', TextType::class)
            ->add('horizontalPriorityType', EntityType::class, [
                'class' => 'AppBundle:HorizontalPriorityType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('verticalPriorityType', EntityType::class, [
                'class' => 'AppBundle:VerticalPriorityType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('projectStatusType', EntityType::class, [
                'class' => 'AppBundle:ProjectStatusType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('projectScopeType', EntityType::class, [
                'class' => 'AppBundle:ProjectScopeType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('contactPersonKa2', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('ftOfficers', EntityType::class, [
                'class' => 'AppBundle:ProjectFtOfficer',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('eaceaOfficers', EntityType::class, [
                'class' => 'AppBundle:ProjectEaceaOfficer',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('remarkOfficer', TextareaType::class)
            ->add('projectGradeType', EntityType::class, [
                'class' => 'AppBundle:ProjectGradeType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('remarkGrade', TextareaType::class)
            ->add('projectSummaryEnglish', TextareaType::class)
            ->add('projectSummarySerbian', TextareaType::class)
            ->add('projectSummaryNative', TextareaType::class)
            ->add('projectObjectivesEnglish', TextareaType::class)
            ->add('projectObjectivesSerbian', TextareaType::class)
            ->add('projectObjectivesNative', TextareaType::class)
            ->add('projectTargetGroup', CollectionType::class, array(
                'entry_type'  => ProjectTargetGroupForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('subjectAreas', CollectionType::class, array(
                'entry_type'  => ProjectSubjectAreasForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('projectPriority', CollectionType::class, array(
                'entry_type'  => ProjectPriorityForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('contacts', CollectionType::class, array(
                'entry_type'  => ProjectContactForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
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
