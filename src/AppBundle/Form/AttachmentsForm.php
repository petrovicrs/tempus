<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 31.08.17
 * Time: 00:06
 */

namespace AppBundle\Form;

use AppBundle\Entity\Attachments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentsForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //TODO - check how this is used
//            ->add('dmsDocuments', EntityType::class, [
//                'class'         => 'AppBundle\Entity\ActivityType',
//                'choice_label'  => 'name' . ucfirst($options['locale']),
//                'label' => false
//            ])
            ->add('manuallyUploadedFiles', CollectionType::class, array(
                'entry_type' => AttachmentsManuallyUploadedForm::class,
                'allow_add' => true,
                'by_reference' => false,
                'label' => false,
                'mapped' => false,
                'required' => false
            ))
            ->add('dmsNotes')
            ->add('uploadedFilesNotes');
            if ($options['isCompleted']) {
                $builder->add('submit', SubmitType::class, array('label_format' => 'Save Changes'));
            }
            else {
                $builder->add('submit', SubmitType::class, array('label_format' => 'Next'));
            }

//        , FileType::class, [
//        'multiple' => true,
//        'attr'     => [
//            'accept' => 'image/*, application/octet-stream, application/pdf, application/msword, application/vnd.ms-excel',
//            'multiple' => 'multiple'
//        ]
//    ]
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
            'data_class' => Attachments::class,
            'isCompleted' => 0,
        ]);
    }
}