<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 13:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\ProjectResources;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectResourcesForm extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('resources', CollectionType::class, [
                'entry_type'    => ResourcesForm::class,
                'allow_add'     => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label'        => false
            ]);
            if ($options['isCompleted']) {
                $builder->add('submit', SubmitType::class, array('label_format' => 'Save Changes'));
            }
            else {
                $builder->add('submit', SubmitType::class, array('label_format' => 'Next'));
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
            'data_class' => ProjectResources::class,
            'allow_extra_fields' => true,
            'isCompleted' => 0,
        ]);
    }
}