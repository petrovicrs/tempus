<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\FieldOfExpertise;
use AppBundle\Entity\Person;
use AppBundle\Entity\UserPermission;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserPermissionForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('peopleView', CheckboxType::class, array('required' => false))
            ->add('peopleEdit', CheckboxType::class, array('required' => false))
            ->add('peopleDelete', CheckboxType::class, array('required' => false))
            ->add('peopleExport', CheckboxType::class, array('required' => false))
            ->add('activitiesView', CheckboxType::class, array('required' => false))
            ->add('activitiesEdit', CheckboxType::class, array('required' => false))
            ->add('activitiesDelete', CheckboxType::class, array('required' => false))
            ->add('activitiesExport', CheckboxType::class, array('required' => false))
            ->add('deliverablesView', CheckboxType::class, array('required' => false))
            ->add('deliverablesEdit', CheckboxType::class, array('required' => false))
            ->add('deliverablesDelete', CheckboxType::class, array('required' => false))
            ->add('deliverablesExport', CheckboxType::class, array('required' => false))
            ->add('monitoringView', CheckboxType::class, array('required' => false))
            ->add('monitoringEdit', CheckboxType::class, array('required' => false))
            ->add('monitoringDelete', CheckboxType::class, array('required' => false))
            ->add('monitoringExport', CheckboxType::class, array('required' => false))
            ->add('partnersView', CheckboxType::class, array('required' => false))
            ->add('partnersEdit', CheckboxType::class, array('required' => false))
            ->add('partnersDelete', CheckboxType::class, array('required' => false))
            ->add('partnersExport', CheckboxType::class, array('required' => false))
            ->add('resourcesView', CheckboxType::class, array('required' => false))
            ->add('resourcesEdit', CheckboxType::class, array('required' => false))
            ->add('resourcesDelete', CheckboxType::class, array('required' => false))
            ->add('resourcesExport', CheckboxType::class, array('required' => false))
            ->add('intoutputsView', CheckboxType::class, array('required' => false))
            ->add('intoutputsEdit', CheckboxType::class, array('required' => false))
            ->add('intoutputsDelete', CheckboxType::class, array('required' => false))
            ->add('intoutputsExport', CheckboxType::class, array('required' => false))
            ->add('resultsView', CheckboxType::class, array('required' => false))
            ->add('resultsEdit', CheckboxType::class, array('required' => false))
            ->add('resultsDelete', CheckboxType::class, array('required' => false))
            ->add('resultsExport', CheckboxType::class, array('required' => false))
            ->add('reportingView', CheckboxType::class, array('required' => false))
            ->add('reportingEdit', CheckboxType::class, array('required' => false))
            ->add('reportingDelete', CheckboxType::class, array('required' => false))
            ->add('reportingExport', CheckboxType::class, array('required' => false))
            ->add('attachmentsView', CheckboxType::class, array('required' => false))
            ->add('attachmentsEdit', CheckboxType::class, array('required' => false))
            ->add('attachmentsDelete', CheckboxType::class, array('required' => false))
            ->add('attachmentsExport', CheckboxType::class, array('required' => false))
            ->add('calendarView', CheckboxType::class, array('required' => false))
            ->add('calendarEdit', CheckboxType::class, array('required' => false))
            ->add('calendarDelete', CheckboxType::class, array('required' => false))
            ->add('calendarExport', CheckboxType::class, array('required' => false))
            ->add('usersView', CheckboxType::class, array('required' => false))
            ->add('usersEdit', CheckboxType::class, array('required' => false))
            ->add('usersDelete', CheckboxType::class, array('required' => false))
            ->add('usersExport', CheckboxType::class, array('required' => false))
            ->add('newprojectView', CheckboxType::class, array('required' => false))
            ->add('newprojectEdit', CheckboxType::class, array('required' => false))
            ->add('newprojectDelete', CheckboxType::class, array('required' => false))
            ->add('newprojectExport', CheckboxType::class, array('required' => false))
            ->add('newinstitutionView', CheckboxType::class, array('required' => false))
            ->add('newinstitutionEdit', CheckboxType::class, array('required' => false))
            ->add('newinstitutionDelete', CheckboxType::class, array('required' => false))
            ->add('newinstitutionExport', CheckboxType::class, array('required' => false))
//            ->add('user', CollectionType::class, array(
//                'entry_type'   => UserForm::class,
//                'allow_add' => false,
//                'by_reference' => false,
//                'allow_delete' => false,
//                'label' => false
//            ))
//            ->add('addresses', CollectionType::class, array(
//                'entry_type'   => PersonAddressForm::class,
//                'allow_add' => true,
//                'by_reference' => false,
//                'allow_delete' => true,
//                'label' => false
//            ))
//            ->add('personNotes', CollectionType::class, array(
//                'entry_type'   => PersonNoteForm::class,
//                'allow_add' => true,
//                'by_reference' => false,
//                'allow_delete' => true,
//                'label' => false
//            ))
            ->add('submit', SubmitType::class);
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
            'data_class' => UserPermission::class,
        ]);

    }
}
