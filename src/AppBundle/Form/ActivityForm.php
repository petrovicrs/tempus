<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 22.07.17
 * Time: 12:42
 */

namespace AppBundle\Form;


use AppBundle\Entity\Activity;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('activityType', EntityType::class, [
                'class'         => 'AppBundle\Entity\ActivityType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('isValidated', CheckboxType::class, ['required' => false, 'label_format' => 'Validation?'])
            ->add('validationType', EntityType::class, [
                'class'         => 'AppBundle\Entity\ValidationType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('isLongTerm', CheckboxType::class, ['required' => false, 'label_format' => 'Is this long term activity'])
            ->add('actionDetails', CollectionType::class, array(
                'entry_type'   => ActionDetailsForm::class,
                'allow_add'    => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label'        => false
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
            'data_class' => Activity::class,
            'allow_extra_fields' => true,
        ]);
    }
}