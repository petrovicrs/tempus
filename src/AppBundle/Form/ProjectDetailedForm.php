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

class ProjectDetailedForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameEn', TextType::class)
            ->add('nameSr', TextType::class)
            ->add('nameOriginalLetter', TextType::class)
            ->add('acronym', TextType::class)
            ->add('endDatetime', DateType::class)
            ->add('startDatetime', DateType::class)
            ->add('projectNumber', TextType::class)
            ->add('durationMonths', TextType::class)
            ->add('audited', CheckboxType::class, array('required' => false))
            ->add('onGoing', CheckboxType::class, array('required' => false))
            ->add('applicantOrganisations', CollectionType::class, array(
                'entry_type'  => ProjectApplicantOrganisationForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('participantFewerOptions', CheckboxType::class, array('required' => false))
            ->add('consortium', CheckboxType::class, array('required' => false))
            ->add('partnerOrganisations', CollectionType::class, array(
                'entry_type'  => ProjectParnerOrganisationForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('limitations', CollectionType::class, array(
                'entry_type'  => ProjectLimitationsForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('contactPersons', CollectionType::class, array(
                'entry_type'  => ProjectContactPersonForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('topics', CollectionType::class, array(
                'entry_type'  => ProjectTopicsForm::class,
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
            ->add('notes', CollectionType::class, array(
                'entry_type'  => ProjectNoteForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('projectSummary', TextareaType::class)
            ->add('submit', SubmitType::class, array('label_format' => 'Next'));
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
