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
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use AppBundle\Entity\ContactType;

use AppBundle\Entity\PicNumber;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class InstitutionsForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nameEn', TextType::class, ['label_format' => 'Organisation name English'])
            ->add('nameSr', TextType::class, ['label_format' => 'Organisation name Serbian'])
            ->add('nameOriginalLetter', TextType::class, ['label_format' => 'Organisation name Original Alphabet'])
            ->add('nationalRegistrationNumber', TextType::class, ['label_format' => 'National Registration Number'])
            ->add('vatNumber', TextType::class, ['label_format' => 'Vat/Tax Number'])
            ->add('acronym', TextType::class, ['label_format' => 'Acronym'])
            ->add('picNumber', TextType::class)
            ->add('picValidated', CheckboxType::class)
            ->add('picPrimary', RadioType::class)
            ->add('streetAndNumber', TextType::class)
            ->add('town', TextType::class)
            ->add('post_code', TextType::class)
            ->add('contactType', EntityType::class, [
                'class' => 'AppBundle:ContactType',
                'choice_label' => 'type' . ucfirst($options['locale'])
            ])








            ->add('parentInstitution', TextType::class, ['label_format' => 'Parent Institution'])
//            ->add('founder', TextType::class, ['label_format' => 'Founder'])
//            ->add('founderOriginalLetter', TextType::class, ['label_format' => 'Founder Original Letter'])
//            ->add('legalRepresentative', TextType::class, ['label_format' => 'Legal Representative'])
//            ->add('contactPerson', EntityType::class, [
//                'class' => 'AppBundle:Person',
//                'choice_label' => 'name',
//                'label_format' => 'Contact Person'
//            ])
//            ->add('hierarchyLevel', TextType::class, ['label_format' => 'Hierarchy Level'])
            ->add('institutionType', TextType::class, ['label_format' => 'Institution Type'])
//            ->add('country', TextType::class, ['label_format' => 'Country'])
//            ->add('founderType', TextType::class, ['label_format' => 'Founder Type'])
//            ->add('founderCountry', TextType::class, ['label_format' => 'Founder Country'])
//            ->add('address', TextType::class, ['label_format' => 'Address'])
//            ->add('postalCode', TextType::class, ['label_format' => 'Postal Code'])
//            ->add('city', TextType::class, ['label_format' => 'City'])
            ->add('webSite', TextType::class, ['label_format' => 'Web Site'])
//            ->add('belongingToGroup', TextType::class, ['label_format' => 'Belonging To Group'])
            ->add('note', TextType::class, ['label_format' => 'Note'])
//            ->add('accreditation', TextType::class, ['label_format' => 'Accreditation'])
//            ->add('accreditationValidFrom', DateType::class, ['label_format' => 'Accreditation Valid From'])
//            ->add('accreditationValidTo', DateType::class, ['label_format' => 'Accreditation Valid To'])
//            ->add('accredditation', TextType::class, ['label_format' => 'Accreditation'])
//            ->add('accreditationValidFrom', DateType::class, ['label_format' => 'Accreditation Valid From'])
//            ->add('accreditationValidTo', DateType::class, ['label_format' => 'Accreditation Valid To'])
//            ->add('accreditor', TextType::class, ['label_format' => 'Accreditor'])
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
