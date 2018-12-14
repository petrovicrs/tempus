<?php

namespace AppBundle\Form\UserForm;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class UserPermissionForm
 *
 * @package AppBundle\Form\User
 */
class UserPermissionForm extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
    }


//    public function configureOptions(OptionsResolver $resolver) {
//        $resolver->setDefaults(
//            [
//                'create' => false,
//                'edit' => false,
//                'delete' => false,
//                'view' => false,
//                'projectCreate' => false,
//                'projectViewAll' => false,
//                'projectEditAll' => false,
//                'projectDeleteAll' => false,
//                'institutionCreate' => false,
//                'institutionViewAll' => false,
//                'institutionEditAll' => false,
//                'institutionDeleteAll' => false,
//                'locale' => 'en',
//                'data_class' => null,
//            ]
//        );
//
//    }
}
