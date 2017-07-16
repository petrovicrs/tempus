<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

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
            ->add('firstNameOriginalLetter')
            ->add('lastNameEn')
            ->add('lastNameSr')
            ->add('lastNameOriginalLetter')
            ->add('initials')
            ->add('titlePrefix')
            ->add('titleSuffix')
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
