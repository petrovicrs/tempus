<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/8/17
 * Time: 12:28 PM
 */
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use AppBundle\Entity\PicNumber;

class PicNumberForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number')
            ->add('validated', CheckboxType::class, ['required' => false])
            ->add('primary', RadioType::class, ['required' => false]);
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
            'data_class' => PicNumber::class,
        ]);

    }
}