<?php
/**
 * Created by PhpStorm.
 * User: jovanmijatovic
 * Date: 6/4/17
 * Time: 9:39 AM
 */
namespace AppBundle\Form;

use AppBundle\Entity\Person;
use AppBundle\Entity\ProjectContactPerson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectContactPersonForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('person', EntityType::class, [
                'class' => 'AppBundle:Person',
                'choice_label' => function($value, $key, $index) use ($options) {
                    return $this->getPersonLabel($options['locale'], $value);
                }
            ]);
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
            'data_class' => ProjectContactPerson::class,
        ]);

    }

    /**
     * @param $locale
     * @param $person Person
     * @return string
     */
    public function getPersonLabel($locale, $person)
    {
        $idAndName = $person->getId() . ' - ' . $person->getName($locale);

        $personOrganisation = $person->getPersonOrganisation($locale) ? ' - ' . $person->getPersonOrganisation($locale) : '';

        $personCountry = $person->getPersonCountry($locale) ? ' - ' . $person->getPersonCountry($locale) : '';

        return $idAndName . $personOrganisation . $personCountry;
    }
}
