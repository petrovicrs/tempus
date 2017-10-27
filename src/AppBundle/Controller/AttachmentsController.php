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
use AppBundle\Util\FileTypeHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

            /** @var FileBag $files */
            $files = $request->files->get('appbundle_project')['manuallyUploadedFiles'];

            /* @var AttachmentsManuallyUploaded $manuallyUploadedFile */
            foreach ($attachments->getManuallyUploadedFiles() as $key => $manuallyUploadedFile) {

                /** @var UploadedFile $file */
                $file = $files[$key]['file'];

                if(false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {

                    /** @var File $uploadedFile */
                    $uploadedFile = $this->get('util.file_uploader')->upload($file);

                    $manuallyUploadedFile->setFile($uploadedFile->getFilename());
                    $manuallyUploadedFile->setType($file->getClientOriginalExtension());
                    $manuallyUploadedFile->setOriginalFileName($file->getClientOriginalName());
                    $manuallyUploadedFile->setAttachments($attachments);
                }
            }

            $this->getAttachmentsRepository()->save($attachments);

            return $this->redirectToRoute('group_calendar_create');
        }

        return $this->render('attachments/create.twig', [
            'my_form' => $attachmentsForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'projectId' => $project->getId(),
            'attachments' => null
        ]);
    }

    /**
     * @Route("/{locale}/attachments/edit/{projectId}", name="attachment_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     */
    public function editAction(Request $request, $projectId)
    {
        $attachments = $this->getAttachmentsRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        /* @var AttachmentsManuallyUploaded $value */
        foreach ($attachments->getManuallyUploadedFiles() as $value) {
            $value->setFile(
                new File($this->getParameter('file_uploads_directory') . DIRECTORY_SEPARATOR . $value->getFile())
            );
        }

        $attachmentsForm = $this->createForm(AttachmentsForm::class, $attachments, [
            'action' => $this->generateUrl('attachment_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale()
        ]);

        $dmsDocuments = new ArrayCollection();
        $uploadedFiles = new ArrayCollection();

        /** @var AttachmentsDmsDocuments $file */
        foreach ($attachments->getDmsDocuments() as $file) {
            $dmsDocuments->add($file);
        }

        foreach ($attachments->getManuallyUploadedFiles() as $file) {
            $uploadedFiles->add($file);
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

            /** @var AttachmentsManuallyUploaded $file */
            foreach($uploadedFiles as $file){
                if(false === $attachments->getManuallyUploadedFiles()->contains($file)) {
                    $em->remove($file);
                }
            }
            /** @var ProjectTopic $topic */
            foreach ($project->getTopics() as $topic) {
                if (false === $originalTopics->contains($topic)) {
                    $topic->setProject($project);
                    $this->getProjectTopicRepository()->save($topic);
                }
            }

            /** @var FileBag $files */
            $files = $request->files->get('appbundle_project')['manuallyUploadedFiles'];

            /* @var AttachmentsManuallyUploaded $manuallyUploadedFile */
            foreach ($attachments->getManuallyUploadedFiles() as $key => $manuallyUploadedFile) {

                /** @var UploadedFile $file */
                $file = $files[$key]['file'];

                if(false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {
                    var_dump($file->getClientOriginalExtension(), $key);

                    /** @var File $uploadedFile */
                    $uploadedFile = $this->get('util.file_uploader')->upload($file);

                    $manuallyUploadedFile->setFile($uploadedFile->getFilename());
                    $manuallyUploadedFile->setType($file->getClientOriginalExtension());
                    $manuallyUploadedFile->setOriginalFileName($file->getClientOriginalName());
                    $manuallyUploadedFile->setAttachments($attachments);
                }
            }

            $this->getAttachmentsRepository()->save($attachments);

            if (!$project->getIsCompleted()){
                return $this->redirectToRoute('group_calendar_create');
            }

        }

        return $this->render('attachments/edit.twig', [
            'my_form' => $attachmentsForm->createView(),
            'attachments' => $attachments,
            'projectId' => $projectId,
            'keyAction' => $project->getKeyActions()->getNameSr()
        ]);
    }

    /**
     * @Route("/{locale}/attachments/view/{id}", name="attachment_view", requirements={"id": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($id)
    {
        $attachments = $this->getAttachmentsRepository()->findOneBy(['project' => $id]);
        return $this->render('attachments/view.twig', [
            'attachments' => $attachments,
            'keyAction' => $attachments->getProject()->getKeyActions()->getNameSr()
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
}