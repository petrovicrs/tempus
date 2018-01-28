<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 15.10.17
 * Time: 10:57
 */

namespace AppBundle\Form;

use AppBundle\Entity\ProjectDeliverablesActivities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectDeliverablesActivitiesForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('deliverables', CollectionType::class, [
                'entry_type'    => ProjectDeliverableForm::class,
                'allow_add'     => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label'        => false
            ])
            ->add('activities', CollectionType::class, [
                'entry_type'    => ProjectActivityForm::class,
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
            'data_class' => ProjectDeliverablesActivities::class,
            'isCompleted' => 0,
        ]);

    }
}