<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Results;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResultsForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resultType', EntityType::class, [
                'class'         => 'AppBundle\Entity\ResultType',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
//            ->add('project', EntityType::class, [
//                'class'         => 'AppBundle\Entity\Project',
//                'choice_label'  => 'name' . ucfirst($options['locale']),
//            ])
            ->add('resultStatus', EntityType::class, [
                'class'         => 'AppBundle\Entity\ResultStatus',
                'choice_label'  => 'name' . ucfirst($options['locale']),
            ])
            ->add('isPublic', CheckboxType::class, [
//                'label' => 'Public?',
                'required' => false
            ])
            ->add('showDescription', CheckboxType::class, [
                'required' => false
            ])
            ->add('titleEn')
            ->add('titleSr')
            ->add('descriptionEn')
            ->add('descriptionSr')
            ->add('notes')
            ->add('submit', SubmitType::class, ['label_format' => 'Next']);
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
            'data_class' => Results::class
        ]);
    }
}