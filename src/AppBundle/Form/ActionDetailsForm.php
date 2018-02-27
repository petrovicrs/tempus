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
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
                },
                'required' => false
            ])
            ->add('institution', EntityType::class, [
                'class' => 'AppBundle\Entity\Institution',
                'choice_label' => 'name' . ucfirst($locale),
                'required' => false
            ])
            ->add('originCountry', EntityType::class, [
                'class' => 'AppBundle\Entity\Country',
                'choice_label' => 'name' . ucfirst($locale),
                'required' => false
            ])
            ->add('destinationCountry', EntityType::class, [
                'class' => 'AppBundle\Entity\Country',
                'choice_label' => 'name' . ucfirst($locale),
                'required' => false
            ])
            ->add('incomingOutgoing', EntityType::class, [
                'class' => 'AppBundle\Entity\IncomingOutgoing',
                'choice_label' => 'name' . ucfirst($locale),
                'required' => false
            ])
            ->add('trainingShip', EntityType::class, [
                'class' => 'AppBundle\Entity\TrainingShip',
                'choice_label' => 'name' . ucfirst($locale),
                'required' => false
            ])
            ->add('distance', TextType::class, ['required' => false])
            ->add('startDate', DateType::class, ['label_format' => 'Start Date', 'required' => false])
            ->add('endDate', DateType::class, ['label_format' => 'End Date', 'required' => false])
            ->add('daysWithoutTravel', IntegerType::class, ['label_format' => 'Total days excluding travel days', 'required' => false])
            ->add('travelDays', IntegerType::class, ['label_format' => 'Travel days', 'required' => false])
            ->add('totalDays', IntegerType::class, ['label_format' => 'Total days', 'required' => false])
            ->add('venue', TextType::class, ['required' => false, 'label_format' => 'Venue'])
            ->add('durationMonths', IntegerType::class, ['required' => false, 'label_format' => 'Duration (full months)'])
            ->add('durationExtraDays', IntegerType::class, ['required' => false, 'label_format' => 'Duration (extra days)'])
            ->add('hasSpecialNeeds', CheckboxType::class, ['required' => false])
            ->add('hasFewerOptions', CheckboxType::class, ['required' => false])
            ->add('isAccompanyingPerson', CheckboxType::class, ['required' => false])
            ->add('student', CheckboxType::class, ['required' => false, 'label_format' => 'Student?'])
            ->add('apprentice', CheckboxType::class, ['required' => false])
            ->add('nonTeachingStuff', CheckboxType::class, ['required' => false])
            ->add('groupLeader', CheckboxType::class, ['label_format' => 'Group Leader', 'required' => false]);
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