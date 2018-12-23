<?php

namespace AppBundle\Form\ProjectProgramForm;

use AppBundle\Entity\ProjectProgramme;
use AppBundle\Repository\ProjectProgrammeRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class UserForm
 *
 * @package AppBundle\Form
 */
class ProgramForm extends AbstractType {

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
        $entity = $builder->getData();
        $builder
            ->add('programType', ChoiceType::class, [
                'label' => 'form.project.form.typeName',
                'multiple' => false,
                'choices' => [
                    'form.project.form.type.program' => ProjectProgramme::TYPE_PROGRAM,
                    'form.project.form.type.subprogram' => ProjectProgramme::TYPE_SUBPROGRAM,
                ],
            ])
            ->add('parent', EntityType::class, [
                'label' => 'form.project.form.parent',
                'class' => 'AppBundle:ProjectProgramme',
                'choice_label' => 'name' . ucfirst($options['locale']),
                'empty_data'  => null,
                'required' => false,
                'query_builder' => function(ProjectProgrammeRepository $repo) use ($entity) {
                    $params = null;
                    $queryBuilder = $repo->createQueryBuilder('p');
                    $id = $entity->getId();
                    if (isset($id)) {
                        $params[':programId'] = $id;
                        $queryBuilder->where('p.id <> :programId');
                        $queryBuilder->setParameter(':programId', $id);
                    }
                    return $queryBuilder->orderBy('p.id', 'ASC');
                },
                'attr' => [
                    'class' => 'tree-structure-element',
                    'data-tree-title' => 'form.project.form.parent',
                    'data-tree-structure' => $this->getTreeStructure(),
                ]
            ])
            ->add('nameSr', TextType::class, [
                'label' => 'form.project.form.nameSr',
            ])
            ->add('nameEn', TextType::class, [
                'label' => 'form.project.form.nameEn',
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'form.project.form.isActive',
                'required' => false
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
            'data_class' => ProjectProgramme::class,
            'locale' => 'en',
            'entityManager' => null
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