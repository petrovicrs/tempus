<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 02.09.17
 * Time: 18:06
 */

namespace AppBundle\Form;

use AppBundle\Entity\GroupCalendarEvent;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupCalendarEventForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('eventDate', DateType::class)
            ->add('eventType', EntityType::class, array(
                'class' => 'AppBundle\Entity\GroupCalendarEventType',
                'choice_label' => 'name' . ucfirst($options['locale'])
            ))
            ->add('eventDescription')
            ->add('eventReminder', CollectionType::class, array(
                'entry_type' => EventReminderForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'label' => false
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
            'data_class' => GroupCalendarEvent::class
        ]);
    }
}