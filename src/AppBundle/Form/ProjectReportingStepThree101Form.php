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

class ProjectReportingStepThree101Form extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ulazakIzvestaja', DateType::class)
            ->add('proveruIzvrsio', EntityType::class, [
                'class' => 'AppBundle:User',
                'required' => false,
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName() . ' ' . $value->getSurname();
                },
                'placeholder' => 'Select a value'
            ])
            ->add('potpunaFinansijskaDokumentacija', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('datumPosete', DateType::class)
            ->add('dokumentPregledao', EntityType::class, [
                'class' => 'AppBundle:User',
                'required' => false,
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $value->getName() . ' ' . $value->getSurname();
                },
                'placeholder' => 'Select a value'
            ])
            ->add('potpunaDodatnaDokumentacija', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('razlogNepotpuneDokumentacije', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('datumTrazenjaDodatneDokumentacije', DateType::class)
            ->add('datumDostavljanjaDodatneDokumentacije', DateType::class)
            ->add('apsorbovatiAlociranBudzet', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('datumZavrsetkaObrade', DateType::class)
            ->add('pitanje1pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje2pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje3pp1pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje4pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje5pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje6pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7pp2', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7pp3', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp1', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp2', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp3', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp4', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp5', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ));
            $builder
            ->add('odobrenoUgovorom1', TextType::class, array('required' => false))
            ->add('odobrenoUgovorom2', TextType::class, array('required' => false))
            ->add('odobrenoUgovorom3', TextType::class, array('required' => false))
            ->add('odobrenoUgovorom4', TextType::class, array('required' => false))
            ->add('odobrenoUgovorom5', TextType::class, array('required' => false))
            ->add('odobrenoUgovorom6', TextType::class, array('required' => false))
            ->add('nakonRealokacija1', TextType::class, array('required' => false))
            ->add('nakonRealokacija2', TextType::class, array('required' => false))
            ->add('nakonRealokacija3', TextType::class, array('required' => false))
            ->add('nakonRealokacija4', TextType::class, array('required' => false))
            ->add('nakonRealokacija5', TextType::class, array('required' => false))
            ->add('nakonRealokacija6', TextType::class, array('required' => false))
            ->add('zavrsnomIzvestaju1', TextType::class, array('required' => false))
            ->add('zavrsnomIzvestaju2', TextType::class, array('required' => false))
            ->add('zavrsnomIzvestaju3', TextType::class, array('required' => false))
            ->add('zavrsnomIzvestaju4', TextType::class, array('required' => false))
            ->add('zavrsnomIzvestaju5', TextType::class, array('required' => false))
            ->add('zavrsnomIzvestaju6', TextType::class, array('required' => false))
            ->add('odobrenihUgovorom1', TextType::class, array('required' => false))
            ->add('odobrenihUgovorom2', TextType::class, array('required' => false))
            ->add('odobrenihUgovorom3', TextType::class, array('required' => false))
            ->add('odobrenihUgovorom4', TextType::class, array('required' => false))
            ->add('odobrenihUgovorom5', TextType::class, array('required' => false))
            ->add('odobrenihUgovorom6', TextType::class, array('required' => false));
            $builder
            ->add('zatrazenihZavrsimIzvescem1', TextType::class, array('required' => false))
            ->add('zatrazenihZavrsimIzvescem2', TextType::class, array('required' => false))
            ->add('zatrazenihZavrsimIzvescem3', TextType::class, array('required' => false))
            ->add('zatrazenihZavrsimIzvescem4', TextType::class, array('required' => false))
            ->add('zatrazenihZavrsimIzvescem5', TextType::class, array('required' => false))
            ->add('zatrazenihZavrsimIzvescem6', TextType::class, array('required' => false))
            ->add('danaNakonZavrsnogIzvesca1', TextType::class, array('required' => false))
            ->add('danaNakonZavrsnogIzvesca2', TextType::class, array('required' => false))
            ->add('danaNakonZavrsnogIzvesca3', TextType::class, array('required' => false))
            ->add('danaNakonZavrsnogIzvesca4', TextType::class, array('required' => false))
            ->add('danaNakonZavrsnogIzvesca5', TextType::class, array('required' => false))
            ->add('danaNakonZavrsnogIzvesca6', TextType::class, array('required' => false))
            ->add('odobrenoZavrsnogIzvesca1', TextType::class, array('required' => false))
            ->add('odobrenoZavrsnogIzvesca2', TextType::class, array('required' => false))
            ->add('odobrenoZavrsnogIzvesca3', TextType::class, array('required' => false))
            ->add('odobrenoZavrsnogIzvesca4', TextType::class, array('required' => false))
            ->add('odobrenoZavrsnogIzvesca5', TextType::class, array('required' => false))
            ->add('odobrenoZavrsnogIzvesca6', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija1', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija2', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija3', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija4', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija5', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija6', TextType::class, array('required' => false))
            ->add('ukupnoDoSadaUpalceno', TextType::class, array('required' => false));
            $builder
            ->add('preostaloZaIsplatu', TextType::class, array('required' => false))
            ->add('preostaloZaPovrat', TextType::class, array('required' => false))
            ->add('finansijskaKorelacija', TextType::class, array('required' => false))
            ->add('komentarObrade', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('smanjenjeGranta', TextType::class, array('required' => false))
            ->add('preostaloZaZavrsnuIsplatu', TextType::class, array('required' => false))
            ->add('preostaloZaPovracaj', TextType::class, array('required' => false));


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