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
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('institutionType', EntityType::class, [
                'class' => 'AppBundle:InstitutionType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('institutionLevel', EntityType::class, [
                'class' => 'AppBundle:InstitutionLevel',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('parentInstitution', EntityType::class, [
                'class' => 'AppBundle:Institution',
                'choice_label' => 'name' . ucfirst($options['locale'])
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
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('originCountry',EntityType::class, [
                'class' => 'AppBundle:Country',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('nationalRegistrationNumber', TextType::class)
            ->add('vatNumber', TextType::class)
            ->add('picNumber', CollectionType::class, array(
                'entry_type'  => PicNumberForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ))
            ->add('webSite', TextType::class)
            ->add('contacts', CollectionType::class, array(
                'entry_type'  => InstitutionContactForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ))
//            ->add('acronym', TextType::class, ['label_format' => 'Acronym'])
//            ->add('picNumber', TextType::class)
//            ->add('picValidated', CheckboxType::class)
//            ->add('picPrimary', RadioType::class)
//            ->add('streetAndNumber', TextType::class)
//            ->add('town', TextType::class)
//            ->add('post_code', TextType::class)
//            ->add('contactType', EntityType::class, [
//                'class' => 'AppBundle:ContactType',
//                'choice_label' => 'type' . ucfirst($options['locale'])
//            ])
//            ->add('contact', TextType::class)
//            ->add('note', TextType::class)
//            ->add('public', CheckboxType::class)

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
