<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 01.09.17
 * Time: 00:25
 */

namespace AppBundle\Form;

use AppBundle\Entity\Attachments;
use AppBundle\Entity\AttachmentsManuallyUploaded;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentsManuallyUploadedForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attachmentManuallyUploadedId', HiddenType::class)
            ->add('file', FileType::class, array(
                'label' => false,
                'file_path' => $options['file_path'],
                'file_name' => $options['file_name'],
                'attr' =>
                    array(
                        'class' => 'form-control btn btn-add btn-success'
                    )
            ));
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
            'file_path' => '',
            'file_name' => '',
            'auto_initialize' => false
        ]);
    }
}