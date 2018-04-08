<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Repository\PicNumberRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use AppBundle\Form\PicNumberForm;

class InstitutionsForm extends AbstractType
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
            ->add('founderOriginalLetterEn', TextType::class)
            ->add('founderOriginalLetterSr', TextType::class)
            ->add('founderOriginalLetter', TextType::class)
            ->add('institutionFounderType', EntityType::class, [
                'class' => 'AppBundle:InstitutionFounderType',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Choose Institution founder type'
            ])
            ->add('institutionType', EntityType::class, [
                'class' => 'AppBundle:InstitutionType',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Choose type of Institution'
            ])
            ->add('institutionLevel', EntityType::class, [
                'class' => 'AppBundle:InstitutionLevel',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Choose Institution level'
            ])
            ->add('parentInstitution', EntityType::class, [
                'class' => 'AppBundle:Institution',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Please choose',
                'empty_data'  => null,
                'required' => false,
                'placeholder' => 'Choose Institution/Organisation'
            ])
            ->add('publicBody', ChoiceType::class, array(
                'choices'  => array(
                    'Yes' => true,
                    'No' => false,
                ),
            ))
            ->add('nonProfit', ChoiceType::class, array(
                'choices'  => array(
                    'Yes' => true,
                    'No' => false,
                ),
            ))
            ->add('country',EntityType::class, [
                'class' => 'AppBundle:Country',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Country'
            ])
            ->add('originCountry',EntityType::class, [
                'class' => 'AppBundle:Country',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Country of origin'
            ])
            ->add('euRegion',EntityType::class, [
                'class' => 'AppBundle:EuRegion',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Choose EU Country'
            ])
            ->add('county',EntityType::class, [
                'class' => 'AppBundle:County',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => 'Choose County'
            ])
            ->add('nationalRegistrationNumber', TextType::class)
            ->add('vatNumber', TextType::class)
            ->add('picNumber', CollectionType::class, array(
                'entry_type'  => PicNumberForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('webSite', TextType::class)
            ->add('contacts', CollectionType::class, array(
                'entry_type'  => InstitutionContactForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('addresses', CollectionType::class, array(
                'entry_type'  => InstitutionAddressForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('accreditations', CollectionType::class, array(
                'entry_type'  => InstitutionAccreditationForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('riskLevel', CollectionType::class, array(
                'entry_type'  => RiskLevelForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('legalRepresentatives', CollectionType::class, array(
                'entry_type'  => InstitutionLegalRepresentativeForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('notes', CollectionType::class, array(
                'entry_type'  => InstitutionNoteForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))

            ->add('submit', SubmitType::class, ['label_format' => 'Submit']);
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
            'locale' => 'en'
        ]);

    }
}
