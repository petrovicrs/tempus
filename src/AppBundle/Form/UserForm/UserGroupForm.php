<?php

namespace AppBundle\Form\UserForm;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\UserGroup;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserGroupForm
 *
 * @package AppBundle\Form\UserForm
 */
class UserGroupForm extends AbstractType {

    /** @var EntityManager */
    private $entityManager;

    /** @var string */
    private $locale;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->entityManager = $options['entityManager'];
        $this->locale = $options['locale'];
        $builder
            ->add('nameEn', TextType::class, [
                'label' => 'common.nameEn',
            ])
            ->add('nameSr', TextType::class, [
                'label' => 'common.nameSr',
            ])
            ->add('program', EntityType::class, [
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'label' => 'form.user_group.program',
                'required' => false,
                'attr' => [
                    'class' => 'tree-structure-element',
                    'data-tree-title' => 'form.user_group.program',
                    'data-tree-structure' => $this->getTreeStructure()
                ]
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'msg.isActive',
                'required' => false,
                'attr' => [
                    'checked' => 'checked'
                ]
            ]);
        if (!$builder->getDisabled()) {
            $builder->add('submit', SubmitType::class, [
                'label' => 'msg.save',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => UserGroup::class,
            'locale' => 'en',
            'entityManager' => null,
        ]);
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