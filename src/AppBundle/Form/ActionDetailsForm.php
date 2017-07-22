<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 13:55
 */

namespace AppBundle\Form;


use AppBundle\Entity\ActionDetails;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionDetailsForm extends AbstractType
{
    private $locale = 'En';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locale = $options['locale'];
        $this->locale = $locale;

        $builder
            ->add('person', EntityType::class, [
                'class' => 'AppBundle\Entity\Person',
                'choice_label' => function($value, $key) {
                    return $value->getName($this->locale);
                }
            ])
            ->add('institution', EntityType::class, [
                'class' => 'AppBundle\Entity\Institution',
                'choice_label' => 'name' . ucfirst($locale)
            ])
            ->add('originCountry', EntityType::class, [
                'class' => 'AppBundle\Entity\Country',
                'choice_label' => 'name' . ucfirst($locale)
            ])
            ->add('destinationCountry', EntityType::class, [
                'class' => 'AppBundle\Entity\Country',
                'choice_label' => 'name' . ucfirst($locale)
            ])
            ->add('city')
            ->add('distance')
            ->add('startDate', DateType::class, ['label_format' => 'Start Date'])
            ->add('endDate', DateType::class, ['label_format' => 'End Date'])
            ->add('daysWithoutTravel', IntegerType::class, ['label_format' => 'Total days excluding travel days'])
            ->add('travelDays', IntegerType::class, ['label_format' => 'Travel days'])
            ->add('totalDays', IntegerType::class, ['label_format' => 'Total days'])
            ->add('hasSpecialNeeds', CheckboxType::class, ['required' => false])
            ->add('hasFewerOptions', CheckboxType::class, ['required' => false])
            ->add('isAccompanyingPerson', CheckboxType::class, ['required' => false])
            ->add('isLongTerm', CheckboxType::class, ['required' => false]);
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
            'data_class' => ActionDetails::class
        ]);
    }
}