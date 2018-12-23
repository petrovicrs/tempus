<?php

namespace AppBundle\Controller;

use AppBundle\DataTableType\OptionFieldOptionsDataTableType;
use AppBundle\Entity\OptionField;
use AppBundle\Entity\OptionFieldOption;
use AppBundle\Form\OptionFields\OptionFieldForm;
use AppBundle\Form\OptionFields\OptionFieldOptionForm;
use AppBundle\Repository\OptionFieldOptionRepository;
use AppBundle\Repository\OptionFieldRepository;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DataTableType\OptionFieldsDataTableType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class OptionFieldsController
 *
 * @package AppBundle\Controller
 */
class OptionFieldsController extends AbstractController {

    /**
     * @Route("/{locale}/admin/option-fields/list", name="option_fields_list", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldListAction(Request $request) {
        $this->setPageTitle($this->translate('page.option_fields.list.title'));
        $table = $this->createDataTableFromType(OptionFieldsDataTableType::class, [], [
            'searching' => true
        ]);
        $table->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        $renderParams = [
            'datatable' => $table,
        ];
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            $renderParams['datatable_link'] = $this->generateUrl('option_field_create', ['locale' => $request->getLocale()]);
            $renderParams['datatable_link_title'] = $this->translate('page.option_fields.add_option.title');
        }
        return $this->render('list/list.html.twig', $renderParams);
    }

    /**
     * @Route("/{locale}/admin/option-fields/create", name="option_field_create", requirements={"locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN')")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldCreateAction(Request $request) {
        $this->setPageTitle($this->translate('page.option_fields.add_option_field.title'));
        $optionField = new OptionField();
        $form = $this->createForm(OptionFieldForm::class, $optionField, [
            'action' => $this->generateUrl('option_field_create'),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OptionFieldRepository $repo */
            $repo = $this->getDoctrine()->getRepository(OptionField::class);
            $repo->save($optionField);
            $this->setInfoMessage($this->translate('page.option_fields.add_option_field.success', [
                '%name%' => $optionField->getName($request->getLocale())
            ]), true);
            return $this->redirectToRoute('option_field_options_list', ['optionFieldId' => $optionField->getId()]);
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('option_fields_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/option-fields/edit/{optionFieldId}", name="option_field_edit", requirements={"optionFieldId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_SUPER_ADMIN')")
     * @param Request $request
     * @param int $optionFieldId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldEditAction(Request $request, int $optionFieldId) {
        $optionField = $this->getDoctrine()->getRepository(OptionField::class)->find($optionFieldId);
        if (!$optionField) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.option_fields.edit_option.title'));
        $form = $this->createForm(OptionFieldForm::class, $optionField, [
            'action' => $this->generateUrl('option_field_edit', ['optionFieldId' => $optionFieldId]),
            'method' => 'POST',
            'is_edit' => true
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OptionFieldRepository $repo */
            $repo = $this->getDoctrine()->getRepository(OptionField::class);
            $repo->save($optionField);
            $this->setInfoMessage($this->translate('page.option_fields.edit_option.success', [
                '%name%' => $optionField->getName($request->getLocale())
            ]), true);
            return $this->redirectToRoute('option_fields_list');
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('option_fields_list')
        ]);
    }

    /**
     * @Route("/{locale}/admin/option-field/{optionFieldId}/options", name="option_field_options_list", requirements={"optionFieldId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @param int $optionFieldId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldOptionsListAction(Request $request, int $optionFieldId) {
        /** @var OptionField $optionField */
        $optionField = $this->getDoctrine()->getRepository(OptionField::class)->find($optionFieldId);
        if (!$optionField) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.option_field_options.list.title', [
            '%name%' => $optionField->getName($request->getLocale())
        ]));
        $table = $this->createDataTableFromType(OptionFieldOptionsDataTableType::class,
            ['optionFieldId' => $optionFieldId], ['searching' => true,]
        );
        $table->handleRequest($request);
        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('list/list.html.twig', [
            'datatable' => $table,
            'back_link' => $this->generateUrl('option_fields_list'),
            'datatable_link' => $this->generateUrl('option_field_option_create', [
                'locale' => $request->getLocale(),
                'optionFieldId' => $optionFieldId
            ]),
            'datatable_link_title' => $this->translate('page.option_field_options.add_option_field_option.title')
        ]);
    }

    /**
     * @Route("/{locale}/admin/option-field/{optionFieldId}/option/create", name="option_field_option_create", requirements={"optionFieldId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @param int $optionFieldId
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldOptionCreateAction(Request $request, int $optionFieldId) {
        $option = new OptionFieldOption();
        /** @var OptionField $optionField */
        $optionField = $this->getDoctrine()->getRepository(OptionField::class)->find($optionFieldId);
        $option->setOptionField($optionField);
        $this->setPageTitle($this->translate('page.option_field_options.add_option_field_option.title_type', [
            '%name%' => $optionField->getName($request->getLocale())
        ]));
        $form = $this->createForm(OptionFieldOptionForm::class, $option, [
            'action' => $this->generateUrl('option_field_option_create', ['optionFieldId' => $optionFieldId]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OptionFieldOptionRepository $repo */
            $repo = $this->getDoctrine()->getRepository(OptionFieldOption::class);
            $repo->save($option);
            $this->setInfoMessage($this->translate('page.option_field_options.add_option_field_option.success', [
                '%name%' => $option->getName($request->getLocale())
            ]), true);
            return $this->redirectToRoute('option_field_options_list', ['optionFieldId' => $optionFieldId]);
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('option_field_options_list', ['optionFieldId' => $optionFieldId])
        ]);
    }

    /**
     * @Route("/{locale}/admin/option-field/{optionFieldId}/option/view/{optionId}", name="option_field_option_view", requirements={"optionFieldId": "\d+", "optionId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @param int $optionFieldId
     * @param int $optionId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldOptionViewAction(Request $request, int $optionFieldId, int $optionId) {
        $optionField = $this->getDoctrine()->getRepository(OptionField::class)->find($optionFieldId);
        if (!$optionField) {
            throw new NotFoundHttpException();
        }
        /** @var OptionFieldOption $optionFieldOption */
        $optionFieldOption = $this->getDoctrine()->getRepository(OptionFieldOption::class)->find($optionId);
        if (!$optionFieldOption) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.option_field_options.view_option_field_option.title', [
            '%name%' => $optionFieldOption->getName($request->getLocale())
        ]));
        $form = $this->createForm(OptionFieldOptionForm::class, $optionFieldOption, [
            'disabled' => true
        ]);
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('option_field_options_list', ['optionFieldId' => $optionFieldId])
        ]);
    }

    /**
     * @Route("/{locale}/admin/option-field/{optionFieldId}/option/edit/{optionId}", name="option_field_option_edit", requirements={"optionFieldId": "\d+", "optionId": "\d+", "locale": "%app.locales%"})
     * @Security("is_granted('ROLE_USER')")
     * @param Request $request
     * @param int $optionFieldId
     * @param int $optionId
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function optionFieldOptionEditAction(Request $request, int $optionFieldId, int $optionId) {
        $optionField = $this->getDoctrine()->getRepository(OptionField::class)->find($optionFieldId);
        if (!$optionField) {
            throw new NotFoundHttpException();
        }
        /** @var OptionFieldOption $optionFieldOption */
        $optionFieldOption = $this->getDoctrine()->getRepository(OptionFieldOption::class)->find($optionId);
        if (!$optionFieldOption) {
            throw new NotFoundHttpException();
        }
        $this->setPageTitle($this->translate('page.option_field_options.edit_option_field_option.title'));
        $form = $this->createForm(OptionFieldOptionForm::class, $optionFieldOption, [
            'action' => $this->generateUrl('option_field_option_edit', [
                'optionFieldId' => $optionFieldId, 'optionId' => $optionId
            ]),
            'method' => 'POST',
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var OptionFieldRepository $repo */
            $repo = $this->getDoctrine()->getRepository(OptionFieldOption::class);
            $repo->save($optionFieldOption);
            $this->setInfoMessage($this->translate('page.option_field_options.edit_option_field_option.success', [
                '%name%' => $optionFieldOption->getName($request->getLocale())
            ]), true);
            return $this->redirectToRoute('option_field_options_list', ['optionFieldId' => $optionFieldId]);
        }
        return $this->render('form/form-inline.html.twig', [
            'form' => $form->createView(),
            'back_link' => $this->generateUrl('option_field_options_list', ['optionFieldId' => $optionFieldId])
        ]);
    }


}