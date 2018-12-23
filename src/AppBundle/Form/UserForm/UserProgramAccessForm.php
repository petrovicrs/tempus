<?php

namespace AppBundle\Form\UserForm;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\UserProgramAccess;
use AppBundle\Entity\UserProjectAccess;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserProjectProgrammePermissionForm
 *
 * @package AppBundle\Form\UserForm
 */
class UserProgramAccessForm extends AbstractType {

    /** @var EntityManager */
    private $entityManager;

    /** @var string */
    private $locale;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->entityManager = $options['entityManager'];
        $this->locale = $options['locale'];
        $builder
            ->add('program', EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'label' => 'form.user.access.program',
                'attr' => [
                    'class' => 'tree-structure-element',
                    'data-tree-title' => 'form.user.access.program',
                    'data-tree-structure' => $this->getTreeStructure()
                ]
            ])
            ->add('hasAccess', ChoiceType::class, [
                'label' => 'Access',
                'choices'  => [
                    'form.user.access.allow' => true,
                    'form.user.access.deny' => false,
                ],
                'attr' => [
                    'class' => 'form-inline'
                ],
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => UserProgramAccess::class,
            'locale' => 'en',
            'entityManager' => null
        ]);
    }

    /**
     * Returns the prefix of the template block name for this type.
     *
     * The block prefix defaults to the underscored short class name with
     * the "Type" suffix removed (e.g. "UserProfileType" => "user_profile").
     *
     * @return string The prefix of the template block name
     */
    public function getBlockPrefix() {
        return "user_program_access_form";
    }

    /**
     * @return string
     */
    private function getTreeStructure() {
        $result = [];
        if ($this->entityManager) {
            $repo = $this->entityManager->getRepository(ProjectProgramme::class);
            /** @var ProjectProgramme[] $programs */
            $programs = $repo->createQueryBuilder('p')
                ->where('p.parent IS NULL AND p.isActive = 1')
                ->getQuery()->execute();
            $result = [];
            foreach ($programs as $program) {
                $this->mapProgram($program, $result);
            }
        }
        return json_encode($result);
    }

    /**
     * @param ProjectProgramme $program
     * @param array $result
     */
    private function mapProgram(ProjectProgramme $program, &$result) {
        $programResult['text'] = $program->getName($this->locale);
        $programResult['data-id'] = $program->getId();
        if ($program->getChildren()->count()) {
            $programResult['nodes'] = [];
            foreach ($program->getChildren() as $child) {
                $this->mapProgram($child, $programResult['nodes']);
            }
        }
        $result[] = $programResult;
    }



}
