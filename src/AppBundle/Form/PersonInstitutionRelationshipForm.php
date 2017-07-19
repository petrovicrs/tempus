<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\Person;
use AppBundle\Entity\PersonContact;
use AppBundle\Entity\PersonInstitutionRelationship;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PersonInstitutionRelationshipForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('institution', EntityType::class, [
                'class' => 'AppBundle:Institution',
                'choice_label'  => 'name' . ucfirst($options['locale'])
            ])
            ->add('personInstitutionRelationshipType', EntityType::class, [
                'class' => 'AppBundle:PersonInstitutionRelationshipType',
                'choice_label'  => 'type' . ucfirst($options['locale'])
            ]);
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
            'data_class' => PersonInstitutionRelationship::class,
        ]);

    }
}