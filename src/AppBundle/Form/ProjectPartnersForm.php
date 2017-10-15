<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 29.08.17
 * Time: 23:43
 */

namespace AppBundle\Form;

use AppBundle\Entity\Partners;
use AppBundle\Entity\ProjectPartners;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectPartnersForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('partners', CollectionType::class, array(
                'entry_type'   => PartnersForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ))
            ->add('participants', CollectionType::class, array(
                'entry_type'   => PartnersParticipantsForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'label' => false
            ));
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
            'data_class' => ProjectPartners::class,
            'isCompleted' => 0,
        ]);

    }
}