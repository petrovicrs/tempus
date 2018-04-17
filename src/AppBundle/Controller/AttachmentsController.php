<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 27.08.17
 * Time: 22:42
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\Attachments;
use AppBundle\Entity\AttachmentsDmsDocuments;
use AppBundle\Entity\AttachmentsManuallyUploaded;
use AppBundle\Form\AttachmentsForm;
use AppBundle\Form\AttachmentsManuallyUploadedForm;
use AppBundle\Repository\FileRepository;
use AppBundle\Util\FileTypeHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\ProjectRepository;
use Twig\Extension\DebugExtension;

class AttachmentsController extends AbstractController
{
    /**
     * @Route("/{locale}/attachments/list", name="attachments_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $attachments = $this->getAttachmentsRepository()->findOneBy(
            ['project' => $this->getLastProjectForCurrentUser()],
            ['id'      => 'DESC']
        );

        return $this->render('attachments/list.twig', ['attachments' => $attachments]);
    }

    /**
     * @Route("/{locale}/attachments/create", name="attachments_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

//        $attachmentExist = $this->getAttachmentsRepository()->findOneBy(
//            ['project' => $project],
//            ['id' => 'DESC']
//        );
//
//        if(false == is_null($attachmentExist)) {
//            return $this->forward('AppBundle:Attachments:edit', ['projectId' => $project->getId()]);
//        }

        $attachments = new Attachments();

        $attachmentsForm = $this->createForm(AttachmentsForm::class, $attachments, [
            'action' => $this->generateUrl('attachments_create'),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $attachmentsForm->handleRequest($request);

        if ($attachmentsForm->isSubmitted() && $attachmentsForm->isValid()) {

            $attachments->setProject($this->getLastProjectForCurrentUser());

            $this->getAttachmentsRepository()->save($attachments);

            /** @var FileBag $files */
            $files = $request->files->get('appbundle_project')['manuallyUploadedFiles'];

            if ($files) {
                foreach ($files as $fileArray) {

                    if(isset($fileArray['file']) && FileTypeHelper::isTypeAllowed($fileArray['file'])) {

                        /** @var UploadedFile $file */
                        $file = $fileArray['file'];
                        /** @var File $uploadedFile */
                        $uploadedFile = $this->get('util.file_uploader')->upload($file);

                        $fileEntity = new \AppBundle\Entity\File();
                        $fileEntity->setFile($uploadedFile->getFilename());
                        $fileEntity->setType($file->getClientOriginalExtension());
                        $fileEntity->setOriginalFileName($file->getClientOriginalName());

                        $this->getFileRepository()->save($fileEntity);

                        $manuallyUploadedFile = new AttachmentsManuallyUploaded();
                        $manuallyUploadedFile->setAttachments($attachments);
                        $manuallyUploadedFile->setFile($fileEntity);

                        $this->getAttachmentsManuallyUploadedRepository()->save($manuallyUploadedFile);
                    }
                }
            }


            return $this->redirectToRoute('group_calendar_create');
        }

        return $this->render('attachments/create.twig', [
            'my_form' => $attachmentsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'attachments' => null,
            'actionTab' => $this->showActionTab($project),
            'isCompleted' => $project->getIsCompleted()
        ]);
    }

    /**
     * @Route("/{locale}/attachments/edit/{projectId}", name="attachment_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var Attachments $attachments */
        $attachments = $this->getAttachmentsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (count($attachments) === 0) {
            $attachments = new Attachments();
            $attachments->setProject($project);
            $this->getAttachmentsRepository()->save($attachments);
        }

        $attachmentsForm = $this->createForm(AttachmentsForm::class, $attachments, [
            'action' => $this->generateUrl('attachment_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $dmsDocuments = new ArrayCollection();
        $uploadedFiles = new ArrayCollection();

        /** @var AttachmentsDmsDocuments $file */
        foreach ($attachments->getDmsDocuments() as $file) {
            $dmsDocuments->add($file);
        }

        /** @var AttachmentsManuallyUploaded $manuallyUploadedFile */
        foreach ($attachments->getManuallyUploadedFiles() as $i => $manuallyUploadedFile) {
            $uploadedFiles->add($manuallyUploadedFile);

            $element['file'] = new \Symfony\Component\HttpFoundation\File\File($this->get('util.file_uploader')->getTargetDir()."/".$manuallyUploadedFile->getFile()->getFile());
            $element['attachmentManuallyUploadedId'] = $manuallyUploadedFile->getId();

            $options = [
                'file_path'=> '/'.$request->getLocale().'/project/'.$projectId.'/file/attachment/'.$manuallyUploadedFile->getId(),
                'file_name'=> $manuallyUploadedFile->getFile()->getOriginalFileName()
            ];

            /** @var FormBuilder $formBuilder */
            $formBuilder= $this->get('form.factory')->createNamedBuilder(''.$i, AttachmentsManuallyUploadedForm::class, $element, $options);
            $attachmentsForm->get('manuallyUploadedFiles')->add($formBuilder->getForm());

        }

        $attachmentsForm->handleRequest($request);

        if ($attachmentsForm->isSubmitted() && $attachmentsForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var AttachmentsDmsDocuments $file */
            foreach($dmsDocuments as $file){
                if(false === $attachments->getDmsDocuments()->contains($file)) {
                    $em->remove($file);
                }
            }

            if($attachmentsForm->has('manuallyUploadedFiles')) {

                $newAttachmentsManuallyUploadedDataCollection = $attachmentsForm->get('manuallyUploadedFiles')->getData();

                $existingAttachmentManuallyUploaded = [];
                foreach ($newAttachmentsManuallyUploadedDataCollection as $newAttachmentManuallyUploadedData) {

                    if(isset($newAttachmentManuallyUploadedData['attachmentManuallyUploadedId'])){
                        $existingAttachmentManuallyUploaded[] = $newAttachmentManuallyUploadedData['attachmentManuallyUploadedId'];
                    }
                    else {
                        /** @var UploadedFile $file */
                        $file = $newAttachmentManuallyUploadedData['file'];

                        if (false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {
                            /** @var File $uploadedFile */
                            $uploadedFile = $this->get('util.file_uploader')->upload($file);

                            $fileEntity = new \AppBundle\Entity\File();
                            $fileEntity->setFile($uploadedFile->getFilename());
                            $fileEntity->setType($file->getClientOriginalExtension());
                            $fileEntity->setOriginalFileName($file->getClientOriginalName());

                            $this->getFileRepository()->save($fileEntity);

                            $attachmentsManuallyUploadedEntity = new AttachmentsManuallyUploaded();
                            $attachmentsManuallyUploadedEntity->setAttachments($attachments);
                            $attachmentsManuallyUploadedEntity->setFile($fileEntity);

                            $this->getAttachmentsManuallyUploadedRepository()->save($attachmentsManuallyUploadedEntity);

                            $attachments->getManuallyUploadedFiles()->add($attachmentsManuallyUploadedEntity);
                        }
                    }
                }

                /** @var AttachmentsManuallyUploaded $attachmentsManuallyUploaded */
                foreach ($uploadedFiles as $attachmentsManuallyUploaded){
                    if(!in_array($attachmentsManuallyUploaded->getId(), $existingAttachmentManuallyUploaded)) {
                        /** @var \AppBundle\Entity\File $fileEntity */
                        $fileEntity = $attachmentsManuallyUploaded->getFile();
                        $this->get('util.file_uploader')->remove($fileEntity->getFile());
                        $em->remove($attachmentsManuallyUploaded);
                    }
                }
            }

            $this->getAttachmentsRepository()->save($attachments);

            if (!$project->getIsCompleted()){
                return $this->redirectToRoute('group_calendar_create');
            }

            return $this->redirectToRoute('attachment_edit', ['locale'=> $request->getLocale(), 'projectId' => $projectId]);
        }

        return $this->render('attachments/edit.twig',
            [
                'my_form' => $attachmentsForm->createView(),
                'attachments' => $attachments,
                'projectId' => $projectId,
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'isCompleted' => $project->getIsCompleted(),
                'actionTab' => $this->showActionTab($project),
            ]
        );
    }

    /**
     * @Route("/{locale}/attachments/view/{projectId}", name="attachments_view", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        $attachments = $this->getAttachmentsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);


        return $this->render('attachments/view.twig', [
            'attachments' => $attachments,
            'projectId' => $project->getId(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'actionTab' => $this->showActionTab($project),
        ]);
    }

    private function getAttachmentsRepository()
    {
        return $this->get('doctrine_entity_repository.attachments');
    }

    private function getAttachmentsDmsRepository()
    {
        return $this->get('doctrine_entity_repository.attachments_dms_documents');
    }

    private function getAttachmentsManuallyUploadedRepository()
    {
        return $this->get('doctrine_entity_repository.attachments_manually_uploaded');
    }

    /**
     * @return ProjectRepository
     */
    private function getProjectRepository() {

        return $this->get('doctrine_entity_repository.project');
    }

    /**
     * @return FileRepository
     */
    private function getFileRepository() {

        return $this->get('doctrine_entity_repository.file');
    }
}