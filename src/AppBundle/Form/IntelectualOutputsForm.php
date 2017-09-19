<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\IntelectualOutputs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IntelectualOutputsForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'class'         => 'AppBundle\Entity\IntelectualOutputsType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
//            ->add('project', EntityType::class, [
//                'class'         => 'AppBundle\Entity\Project',
//                'choice_label'  => 'name' . ucfirst($options['locale']),
//            ])
            ->add('status', EntityType::class, [
                'class'         => 'AppBundle\Entity\IntelectualOutputsStatus',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('dueDate', DateType::class, ['label_format' => 'Due Date'])
            ->add('isPublic', CheckboxType::class, [
//                'label' => 'Public?',
                'required' => false
            ])
            ->add('eLinkAvailable', CheckboxType::class, [
                'required' => false
            ])
            ->add('titleEn')
            ->add('titleSr')
            ->add('descriptionEn')
            ->add('descriptionSr')
            ->add('notes')
            ->add('submit', SubmitType::class, array('label_format' => 'Next'));
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
            'data_class' => IntelectualOutputs::class
        ]);
    }
}