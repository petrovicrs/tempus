<?php
/**
 * Created by PhpStorm.
 * User: marjanapesic
 * Date: 3/10/18
 * Time: 4:06 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectSearchForm extends AbstractType
{

    const ACRONYM = 'acronym';
    const TITLE = 'title';
    const REFERENCE_NUMBER = 'referenceNumber';
    const PROGRAMMES = 'programmes';
    const KEY_ACTIONS = 'keyActions';
    const PARTNER_ORGANIZATION_INSTITUTION = 'partnerOrganizationInstitution';
    const PARTNER_ORGANIZATION_INSTITUTION_COUNTRY = 'partnerOrganizationInstitutionCountry';

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::ACRONYM, TextType::class, [
                'required' => false
            ])
            ->add(self::TITLE, TextType::class, [
                'required' => false
            ])
            ->add(self::REFERENCE_NUMBER, TextType::class, [
                'required' => false
            ])
            ->add(self::PROGRAMMES, EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add(self::KEY_ACTIONS, EntityType::class, [
                'class' => 'AppBundle:ProjectKeyAction',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add(self::PARTNER_ORGANIZATION_INSTITUTION, EntityType::class, [
                'class' => 'AppBundle:Institution',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add(self::PARTNER_ORGANIZATION_INSTITUTION_COUNTRY, EntityType::class, [
                'class' => 'AppBundle:Country',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add('submit', SubmitType::class, array('label_format' => 'Search'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'locale' => 'en'
        ]);

    }

}