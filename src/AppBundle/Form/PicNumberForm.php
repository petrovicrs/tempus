<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 7/8/17
 * Time: 12:28 PM
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\PicNumber;

class PicNumberForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number');
//            ->add('validated', CheckboxType::class)
//            ->add('primary', CheckboxType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => PicNumber::class,
        ));
    }
}