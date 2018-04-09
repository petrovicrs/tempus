<?php
namespace AppBundle\FormType;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FileTypeExtension
 */
class FileTypeExtension extends AbstractTypeExtension
{
    /**
     * Returns the name of the type being extended.
     *
     * @return string The name of the type being extended
     */
    public function getExtendedType()
    {
        return FileType::class;
    }

    /**
     * Add the image_path option
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(array('file_path', 'file_name'));
    }

    /**
     * Pass the image url to the view
     *
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (array_key_exists('file_path', $options)) {
//            $parentData = $form->getParent()->getData();
//
//            if (null !== $parentData) {
//                $propertyPath = new PropertyPath($options['file_path']);
//                $fileUrl = $propertyPath->getValue($parentData);
//            } else {
//                $fileUrl = null;
//            }

            $fileUrl = $options['file_path'];
            $view->vars['file_url'] = $fileUrl;
        }

        if (array_key_exists('file_name', $options)) {
//            $parentData = $form->getParent()->getData();
//
//            if (null !== $parentData) {
//                $propertyPath = new PropertyPath($options['file_name']);
//                $fileName = $propertyPath->getValue($parentData);
//            } else {
//                $fileName = null;
//            }
            $fileName = $options['file_name'];
            $view->vars['file_name'] = $fileName;
        }
    }
}