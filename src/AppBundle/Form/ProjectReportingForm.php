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

class ProjectReportingForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('savetnik', EntityType::class, [
                'class' => 'AppBundle:User',
                'required' => false,
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName() . ' ' . $value->getSurname();
                },
                'placeholder' => 'Select a value'
            ])
            ->add('kontroluIzvrsio', EntityType::class, [
                'class' => 'AppBundle:User',
                'required' => false,
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName() . ' ' . $value->getSurname();
                },
                'placeholder' => 'Select a value'
            ])
            ->add('datumPrijemaIzvestaja', DateType::class)
            ->add('periodOd', DateType::class)
            ->add('periodDo', DateType::class)
            ->add('predmetMonitoringa', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('poslednjiMonitoring', DateType::class)
            ->add('uvazenePrporuke', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('dokumentacijaPotupna', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('korisnikDostavioDodatnuDokumentaciju', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje2', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje2pp1', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('pitanje3', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje3pp1', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('pitanje4', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje5', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje6', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8', ChoiceType::class, array(
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'required' => false,
                'expanded'=>true
            ))
            ->add('pitanje9', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                ),
                'placeholder' => 'N/A',
                'required' => false,
                'expanded'=>true
            ))
            ->add('planiranihUcenja', TextType::class, array('required' => false))
            ->add('planiranihObuka', TextType::class, array('required' => false))
            ->add('planiranihPraksi', TextType::class, array('required' => false))
            ->add('planiranihPosmatranja', TextType::class, array('required' => false));
            $builder
            ->add('zapocetihUcenja', TextType::class, array('required' => false))
            ->add('zapocetihObuka', TextType::class, array('required' => false))
            ->add('zapocetihPraksi', TextType::class, array('required' => false))
            ->add('zapocetihPosmatranja', TextType::class, array('required' => false))
            ->add('sprovedenihUcenja', TextType::class, array('required' => false))
            ->add('sprovedenihObuka', TextType::class, array('required' => false))
            ->add('sprovedenihPraksi', TextType::class, array('required' => false))
            ->add('sprovedenihPosmatranja', TextType::class, array('required' => false))
            ->add('potpisanihUcenja', TextType::class, array('required' => false))
            ->add('potpisanihObuka', TextType::class, array('required' => false))
            ->add('potpisanihPraksi', TextType::class, array('required' => false))
            ->add('potpisanihPosmatranja', TextType::class, array('required' => false))
            ->add('pitanje11', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje12', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('pitanje13', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje14', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp1', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp2', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp3', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp4', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp5pp1', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp5pp2', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp5pp3', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje15pp5pp4', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje16', ChoiceType::class, array(
                'choices' => array(
                    'Niska' => 'Niska',
                    'Srednja' => 'Srednja',
                    'Visoka' => 'Visoka',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp1', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp2', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp3', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp4', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp5pp1', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp5pp2', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp5pp3', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje17pp5pp4', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '4',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje18', ChoiceType::class, array(
                'choices' => array(
                    'N/A' => 'N/A',
                    'DA' => 'DA',
                    'NE' => 'NE',

                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje19', ChoiceType::class, array(
                'choices' => array(
                    'Niska' => 'Niska',
                    'Srednja' => 'Srednja',
                    'Visoka' => 'Visoka',

                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje20', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('pitanje21', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('pitanje22', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')));

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