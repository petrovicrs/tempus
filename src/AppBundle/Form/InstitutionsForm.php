<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class InstitutionsForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('parentInstitution', TextType::class, ['label_format' => 'Parent Institution'])
            ->add('name', TextType::class, ['label_format' => 'Name'])
            ->add('founder', TextType::class, ['label_format' => 'Founder'])
            ->add('nameOriginalLetter', TextType::class, ['label_format' => 'Name Original Letter'])
            ->add('founderOriginalLetter', TextType::class, ['label_format' => 'Founder Original Letter'])
            ->add('legalRepresentative', TextType::class, ['label_format' => 'Legal Representative'])
            ->add('contactPerson', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => 'name',
                'label_format' => 'Contact Person'
            ])
            ->add('picNumber', TextType::class, ['label_format' => 'pic Number'])
            ->add('registrationNumber', TextType::class, ['label_format' => 'Registration Number'])
            ->add('vatNumber', TextType::class, ['label_format' => 'VAT Number'])
            ->add('hierarchyLevel', TextType::class, ['label_format' => 'Hierarchy Level'])
            ->add('institutionType', TextType::class, ['label_format' => 'Institution Type'])
            ->add('country', TextType::class, ['label_format' => 'Country'])
            ->add('founderType', TextType::class, ['label_format' => 'Founder Type'])
            ->add('founderCountry', TextType::class, ['label_format' => 'Founder Country'])
            ->add('address', TextType::class, ['label_format' => 'Address'])
            ->add('postalCode', TextType::class, ['label_format' => 'Postal Code'])
            ->add('city', TextType::class, ['label_format' => 'City'])
            ->add('webSite', TextType::class, ['label_format' => 'web Site'])
            ->add('belongingToGroup', TextType::class, ['label_format' => 'Belonging To Group'])
            ->add('note', TextType::class, ['label_format' => 'Note'])
            ->add('accreditation', TextType::class, ['label_format' => 'Accreditation'])
            ->add('accreditationValidFrom', DateType::class, ['label_format' => 'Accreditation Valid From'])
            ->add('accreditationValidTo', DateType::class, ['label_format' => 'Accreditation Valid To'])
            ->add('accreditor', TextType::class, ['label_format' => 'Accreditor'])
            ->add('submit', SubmitType::class, ['label_format' => 'Submit']);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Institution'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_project';
    }
}
