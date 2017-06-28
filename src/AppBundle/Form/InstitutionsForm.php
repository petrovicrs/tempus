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
            ->add('parentInstitution', TextType::class)
            ->add('name', TextType::class)
            ->add('founder', TextType::class)
            ->add('nameOriginalLetter', TextType::class)
            ->add('founderOriginalLetter', TextType::class)
            ->add('legalRepresentative', TextType::class)
            ->add('contactPerson', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => 'name',
            ])
            ->add('picNumber', TextType::class)
            ->add('registrationNumber', TextType::class)
            ->add('vatNumber', TextType::class)
            ->add('hierarchyLevel', TextType::class)
            ->add('institutionType', TextType::class)
            ->add('country', TextType::class)
            ->add('founderType', TextType::class)
            ->add('founderCountry', TextType::class)
            ->add('address', TextType::class)
            ->add('postalCode', TextType::class)
            ->add('city', TextType::class)
            ->add('webSite', TextType::class)
            ->add('belongingToGroup', TextType::class)
            ->add('note', TextType::class)
            ->add('accreditation', TextType::class)
            ->add('accreditationValidFrom', DateType::class)
            ->add('accreditationValidTo', DateType::class)
            ->add('accreditor', TextType::class)
            ->add('submit', SubmitType::class, array('label' => 'Create'));
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
