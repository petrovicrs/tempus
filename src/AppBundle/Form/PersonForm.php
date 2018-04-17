<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\FieldOfExpertise;
use AppBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PersonForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstNameEn')
            ->add('firstNameSr')
            ->add('firstNameOriginalLetter', TextType::class, array('required' => false))
            ->add('lastNameEn')
            ->add('lastNameSr')
            ->add('lastNameOriginalLetter', TextType::class, array('required' => false))
            ->add('initials')
            ->add('titlePrefix', TextType::class, array('required' => false))
            ->add('titleSuffix', TextType::class, array('required' => false))
            ->add('gender', EntityType::class, [
                'class' => 'AppBundle:Gender',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ])
            ->add('hasDisability', CheckboxType::class, array('required' => false))
            ->add('hasFewerOpportunities', CheckboxType::class, array('required' => false))
            ->add('contacts', CollectionType::class, array(
                'entry_type'   => PersonContactForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('addresses', CollectionType::class, array(
                'entry_type'   => PersonAddressForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('personNotes', CollectionType::class, array(
                'entry_type'   => PersonNoteForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('personDocuments', CollectionType::class, array(
                'entry_type'   => PersonDocumentForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('personInstitutionRelationships', CollectionType::class, array(
                'entry_type'   => PersonInstitutionRelationshipForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('fieldOfExpertise')
            ->add('personFacingSituations', CollectionType::class, array(
                'entry_type'   => PersonFacingSituationForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('submit', SubmitType::class);
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
            'data_class' => Person::class,
        ]);

    }
}
