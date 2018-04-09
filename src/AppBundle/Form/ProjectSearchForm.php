<?php
/**
 * Created by PhpStorm.
 * User: marjanapesic
 * Date: 3/10/18
 * Time: 4:06 PM
 */

namespace AppBundle\Form;


use AppBundle\FormEventListener\AddProjectActionSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
    const ACTIONS = 'actions';
    const START_DATE_START = 'startDateStart';
    const START_DATE_END = 'startDateEnd';
    const END_DATE_START = 'endDateStart';
    const END_DATE_END = 'endDateEnd';
    const PARTNER_ORGANIZATION_INSTITUTION = 'partnerOrganizationInstitution';
    const PARTNER_ORGANIZATION_INSTITUTION_COUNTRY = 'partnerOrganizationInstitutionCountry';
    const PARTNER_ORGANIZATION_PERSON = 'partnerOrganizationPerson';
    /** Deliverables */
    const DELIVERABLE_TYPE = "deliverableType";
    const DELIVERABLE_STATUS = "deliverableStatus";
    const DELIVERABLE_TITLE = "deliverableTitle";

    /** Equipment */
    const EQUIPMENT_TYPE = "equipmentType";
    const EQUIPMENT_TITLE = "equipmentTitle";
    const EQUIPMENT_QUANTITY = "equipmentQuantity";
    const EQUIPMENT_DESCRIPTION = "equipmentDescription";

    const SUBJECT_AREA = "subjectArea";

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $years = [];
        for($i = 2012; $i < (date('Y') + 20); $i++) {
            $years[] = $i;
        }

        $builder
            ->addEventSubscriber(new AddProjectActionSubscriber(self::ACTIONS, self::KEY_ACTIONS))
        ;

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
                'data' => 2,
                'required' => false
            ])
//            ->add(self::ACTIONS, EntityType::class, [
//                'class' => 'AppBundle:ProjectAction',
//                'choice_label' => 'name' . ucfirst($options['locale']),
//                'placeholder' => '--',
//                'required' => false
//            ])
            ->add(self::START_DATE_START, DateType::class, [
                'required' => false,
                'years' => $years
            ])
            ->add(self::START_DATE_END, DateType::class, [
                'required' => false,
                'years' => $years
            ])
            ->add(self::END_DATE_START, DateType::class, [
                'required' => false,
                'years' => $years
            ])
            ->add(self::END_DATE_END, DateType::class, [
                'required' => false,
                'years' => $years
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
                'required' => false,
                'multiple' => true,
            ])
            ->add(self::PARTNER_ORGANIZATION_PERSON, TextType::class, [
                'required' => false
            ])
            /** DELIVERABLES */
            ->add(self::DELIVERABLE_TYPE, EntityType::class, [
                'class' => 'AppBundle:ProjectDeliverableType',
                'choice_label' => 'title' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add(self::DELIVERABLE_STATUS, EntityType::class, [
                'class' => 'AppBundle:ProjectDeliverableStatus',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add(self::DELIVERABLE_TITLE, TextType::class, [
                'required' => false
            ])

            ->add(self::SUBJECT_AREA, EntityType::class, [
                'class' => 'AppBundle:ProjectSubjectAreaType',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])

            ->add(self::EQUIPMENT_TYPE, EntityType::class, [
                'class' => 'AppBundle:EquipmentType',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'placeholder' => '--',
                'required' => false
            ])
            ->add(self::EQUIPMENT_TITLE, TextType::class, [
                'required' => false
            ])
            ->add(self::EQUIPMENT_QUANTITY, TextType::class, [
                'required' => false
            ])
            ->add(self::EQUIPMENT_DESCRIPTION, TextType::class, [
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