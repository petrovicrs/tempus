<?php
namespace AppBundle\FormEventListener;

use AppBundle\Entity\ProjectAction;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class AddProjectActionSubscriber implements EventSubscriberInterface
{
    private $propertyNameProjectAction;
    private $propertyNameKeyAction;

    public function __construct($propertyNameProjectAction, $propertyNameKeyAction)
    {
        $this->propertyNameProjectAction = $propertyNameProjectAction;
        $this->propertyNameKeyAction = $propertyNameKeyAction;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA  => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }

    private function addProjectActionForm(FormInterface $form, $keyAction)
    {

        $formOptions = array(
            'class'         => 'AppBundle:ProjectAction',
            'choice_label' => 'nameEn', # todo: figure out how to get locale . ucfirst($options['locale']),
            'placeholder' => '--',
            'required' => false,
            'query_builder' => function (EntityRepository $repository) use ($keyAction) {
                $qb = $repository->createQueryBuilder('projectAction')
                    ->where('projectAction.keyAction = :keyAction')
                    ->setParameter('keyAction', $keyAction)
                ;

                return $qb;
            }
        );

        $form->add($this->propertyNameProjectAction, EntityType::class, $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $keyAction = null;
        if (null !== $data) {
            $accessor = PropertyAccess::createPropertyAccessor();

            /** @var ProjectAction $projectAction */
            $projectAction = $accessor->getValue($data, $this->propertyNameProjectAction);
            $keyAction = ($projectAction) ? $projectAction->getKeyAction() : null;
        }

        $this->addProjectActionForm($form, $keyAction);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $keyAction = array_key_exists($this->propertyNameKeyAction, $data) ? $data[$this->propertyNameKeyAction] : null;
        $this->addProjectActionForm($form, $keyAction);
    }
}