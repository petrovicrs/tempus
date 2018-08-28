<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;

use AppBundle\Entity\ProjectReportingProveraDokumentacije;
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

class ProjectReportingProveraDokumentacijeForm extends AbstractType
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
            ->add('pregledao', EntityType::class, [
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
            ->add('razlogNepotpuneDokumentacije', TextareaType::class, array('required' => false, 'attr' => array('cols' => '50', 'rows' => '5')))
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
            ->add('pitanje1pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje2pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje3pp1pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje4pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje5pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje6pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7pp2;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje7pp3;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp1;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp2;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp3;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp4;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('pitanje8pp5;', ChoiceType::class, array(
                'choices' => array(
                    'DA' => 'DA',
                    'NE' => 'NE',
                    'N/A' => 'N/A',
                ),
                'placeholder' => 'Select a value',
                'required' => false
            ))
            ->add('odobreniTroskoviPuta', TextType::class, array('required' => false))
            ->add('odobrenaIndividualnaPodrska', TextType::class, array('required' => false))
            ->add('odobrenaOrganizacionaPodrska', TextType::class, array('required' => false))
            ->add('odobrenaPodrskaLicaSaInvaliditetom', TextType::class, array('required' => false))
            ->add('odobreniVanredniTroskovi', TextType::class, array('required' => false))
            ->add('odobreniTroskoviKursa', TextType::class, array('required' => false))
            ->add('stanjeTroskovaPutaNakonRealokacija', TextType::class, array('required' => false))
            ->add('stanjeIndividualnaPodrskaNakonRealokacija', TextType::class, array('required' => false))
            ->add('stanjeOrganizacionaPodrskeNakonRealokacija', TextType::class, array('required' => false))
            ->add('stanjePodrskeLicaSaInvaliditetomNakonRealokacija', TextType::class, array('required' => false))
            ->add('stanjeOdobrenihVanrednihTroskovaNakonRealokacija', TextType::class, array('required' => false))
            ->add('stanjeTroskovaKursaNakonRealokacija', TextType::class, array('required' => false))
            ->add('zavrsniIzvestajTackaPrva', TextType::class, array('required' => false))
            ->add('zavrsniIzvestajTackaDruga', TextType::class, array('required' => false))
            ->add('zavrsniIzvestajTackaTreca', TextType::class, array('required' => false))
            ->add('zavrsniIzvestajTackaCetvrta', TextType::class, array('required' => false))
            ->add('zavrsniIzvestajTackaPeta', TextType::class, array('required' => false))
            ->add('zavrsniIzvestajTackaSesta', TextType::class, array('required' => false))
            ->add('brojOdobrenihDanaUcenikaTackaPrva', TextType::class, array('required' => false))
            ->add('brojOdobrenihDanaUcenikaTackaDruga', TextType::class, array('required' => false))
            ->add('brojOdobrenihDanaUcenikaTackaTreca', TextType::class, array('required' => false))
            ->add('brojOdobrenihDanaUcenikaTackaCetvrta', TextType::class, array('required' => false))
            ->add('brojOdobrenihDanaUcenikaTackaPeta', TextType::class, array('required' => false))
            ->add('brojOdobrenihDanaUcenikaTackaSesta', TextType::class, array('required' => false))
            ->add('brojZatrazenihDanaUcenikaTackaPrva', TextType::class, array('required' => false))
            ->add('brojZatrazenihDanaUcenikaTackaDruga', TextType::class, array('required' => false))
            ->add('brojZatrazenihDanaUcenikaTackaTreca', TextType::class, array('required' => false))
            ->add('brojZatrazenihDanaUcenikaTackaCetvrta', TextType::class, array('required' => false))
            ->add('brojZatrazenihDanaUcenikaTackaPeta', TextType::class, array('required' => false))
            ->add('brojZatrazenihDanaUcenikaTackaSesta', TextType::class, array('required' => false))
            ->add('brojDanaUcenikaNakonZavrsnogTackaPrva', TextType::class, array('required' => false))
            ->add('brojDanaUcenikaNakonZavrsnogTackaDruga', TextType::class, array('required' => false))
            ->add('brojDanaUcenikaNakonZavrsnogTackaTreca', TextType::class, array('required' => false))
            ->add('brojDanaUcenikaNakonZavrsnogTackaCetvrta', TextType::class, array('required' => false))
            ->add('brojDanaUcenikaNakonZavrsnogTackaPeta', TextType::class, array('required' => false))
            ->add('brojDanaUcenikaNakonZavrsnogTackaSesta', TextType::class, array('required' => false))
            ->add('odobrenoNakonZavrsnogTackaPrva', TextType::class, array('required' => false))
            ->add('odobrenoNakonZavrsnogTackaDruga', TextType::class, array('required' => false))
            ->add('odobrenoNakonZavrsnogTackaTreca', TextType::class, array('required' => false))
            ->add('odobrenoNakonZavrsnogTackaCetvrta', TextType::class, array('required' => false))
            ->add('odobrenoNakonZavrsnogTackaPeta', TextType::class, array('required' => false))
            ->add('odobrenoNakonZavrsnogTackaSesta', TextType::class, array('required' => false))
            ->add('finansijskaKorekcijaTackaPrva', TextType::class, array('required' => false))
            ->add('finansijskaKorekcijaTackaDruga', TextType::class, array('required' => false))
            ->add('finansijskaKorekcijaTackaTreca', TextType::class, array('required' => false))
            ->add('finansijskaKorekcijaTackaCetvrta', TextType::class, array('required' => false))
            ->add('finansijskaKorekcijaTackaPeta', TextType::class, array('required' => false))
            ->add('finansijskaKorekcijaTackaSesta', TextType::class, array('required' => false))
            ->add('ukupnoUplacenoDoSada', TextType::class, array('required' => false))
            ->add('preostaloZaZavrsnuIsplatu', TextType::class, array('required' => false))
            ->add('preostaloZaPovrat', TextType::class, array('required' => false))
            ->add('finansijskaKorekcija', TextType::class, array('required' => false))
            ->add('komentarDoradeFinansijskogIzvestaja', TextareaType::class, array('required' => false, 'attr' => array('cols' => '100', 'rows' => '5')))
            ->add('smanjenjeGrantaLosKvalitet', TextType::class, array('required' => false));

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
            'data_class' => ProjectReportingProveraDokumentacije::class,
            'allow_extra_fields' => true,
            'isCompleted' => 0,
        ]);
    }
}