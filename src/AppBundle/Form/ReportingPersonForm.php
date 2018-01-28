<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 14.08.17
 * Time: 22:39
 */

namespace AppBundle\Form;

use AppBundle\Entity\ReportingPerson;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportingPersonForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('person', EntityType::class, array(
                'class'   => 'AppBundle\Entity\ReportingPerson',
                'label' => false,
                'choice_label'  => function($value, $key) use ($options){
                    return $value->getName($options['locale']);
                }
            ));
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
            'data_class' => ReportingPerson::class
        ]);
    }
}