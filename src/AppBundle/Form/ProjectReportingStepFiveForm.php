<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\ProjectReporting;
use AppBundle\Entity\Reporting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectReportingStepFiveForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vrstaProjekta', TextType::class, array('required' => false))
            ->add('nazivKorisnika', TextType::class, array('required' => false))
            ->add('sredisteOrganizacije', TextType::class, array('required' => false))
            ->add('datumProvere', DateType::class)
            ->add('referentniBroj', TextType::class, array('required' => false))
            ->add('nazivProjekta', TextType::class, array('required' => false))
            ->add('datumPrijemaIzvestaja', DateType::class)
            ->add('potpis', TextType::class, array('required' => false))
            ->add('propisanomObrascu', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('predatURoku', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('ispunjenUCelosti', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('ispunjenNaJezikuZavrsnogIzvestaja', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('prilozenaIzjava', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('rasporedAktivnosti', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('izvestajJeFormalno', ChoiceType::class, array(
                'choices' => array(
                    'prihvatljiv' => 'prihvatljiv',
                    'neprihvatljiv' => 'neprihvatljiv',
                    'N/A' => 'N/A'
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('komentarObrade', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')));

        if ($options['isCompleted']) {
            $builder->add('submit', SubmitType::class, array('label_format' => 'Save Changes'));
        }
        else {
            $builder->add('submit', SubmitType::class, array('label_format' => 'Save'));
        }
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
            'data_class' => ProjectReporting::class,
            'allow_extra_fields' => true,
            'isCompleted' => 0,
        ]);
    }
}