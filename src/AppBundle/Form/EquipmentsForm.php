<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipmentsForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('equipment', CollectionType::class, [
                'entry_type'    => EquipmentForm::class,
                'allow_add'     => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label'        => false
            ]);
        if ($options['isCompleted']) {
            $builder->add('submit', SubmitType::class, array('label_format' => 'Save Changes',
                'attr' => ['class' => 'btn btn-info']));
        }
        else {
            $builder->add('submit', SubmitType::class, array('label_format' => 'Next',
                'attr' => ['class' => 'btn btn-info']));
        }
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
//            'data_class' => Equipment::class,
            'allow_extra_fields' => true,
            'isCompleted' => 0,
        ]);
    }
}