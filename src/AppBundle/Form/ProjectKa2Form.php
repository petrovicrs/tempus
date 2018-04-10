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
            ->add('types', EntityType::class, [
                'class' => 'AppBundle:ProjectType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('nameEn', TextType::class)
            ->add('nameSr', TextType::class, array('required' => false))
            ->add('nameOriginalLetter', TextType::class, array('required' => false))
            ->add('acronym', TextType::class)
            ->add('endDatetime', DateType::class)
            ->add('startDatetime', DateType::class)
            ->add('durationMonths', IntegerType::class)
            ->add('extendedUntil', DateType::class)
            ->add('audited', CheckboxType::class, array('required' => false))
            ->add('published', CheckboxType::class, array('required' => false))
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
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getId() . ' - ' . $value->getName($options['locale']) .
                        $value->getLastAddress($options['locale']);
                }
            ])
            ->add('ftOfficers', EntityType::class, [
                'class' => 'AppBundle:User',
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName() . ' ' . $value->getSurname();
                }
            ])
            ->add('eaceaOfficers', EntityType::class, [
                'class' => 'AppBundle:User',
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName() . ' ' . $value->getSurname();
                }
            ])
            ->add('remarkOfficer', TextareaType::class, array('required' => false))
            ->add('projectGradeType', EntityType::class, [
                'class' => 'AppBundle:ProjectGradeType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('remarkGrade', TextareaType::class, array('required' => false))
            ->add('projectSummaryEnglish', TextareaType::class)
            ->add('projectSummarySerbian', TextareaType::class, array('required' => false))
            ->add('projectSummaryNative', TextareaType::class, array('required' => false))
            ->add('projectObjectivesEnglish', TextareaType::class)
            ->add('projectObjectivesSerbian', TextareaType::class, array('required' => false))
            ->add('projectObjectivesNative', TextareaType::class, array('required' => false))
//            ->add('participantFewerOptions', CheckboxType::class, array('required' => false))
//            ->add('projectTargetGroupFewerOpportunities', CollectionType::class, array(
//                'entry_type'  => ProjectTargetGroupForm::class,
//                'allow_add' => true,
//                'by_reference' => false,
//                'allow_delete' => true,
//                'label' => false
//            ))
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
            ));
            if ($options['isCompleted']) {
                $builder->add('submit', SubmitType::class, array('label_format' => 'Save Changes'));
            }
            else {
                $builder->add('submit', SubmitType::class, array('label_format' => 'Next'));
            }

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'locale' => 'en',
            'isCompleted' => 0,
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
