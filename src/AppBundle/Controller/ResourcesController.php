<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 07.08.17
 * Time: 12:00
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Project;
use AppBundle\Entity\ProjectResources;
use AppBundle\Entity\Resources;
use AppBundle\Form\ProjectResourcesForm;
use AppBundle\Form\ResourcesForm;
use AppBundle\Repository\FileRepository;
use AppBundle\Repository\ResourcesRepository;
use AppBundle\Repository\ProjectRepository;
use AppBundle\Util\FileTypeHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class ResourcesController extends AbstractController
{
    /**
     * @Route("/{locale}/admin/admin/resources/list", name="resources_list", requirements={"locale": "%app.locales%"})
     */
    public function listAction(Request $request)
    {
        $projectResources = $this->getProjectResourcesRepository()->findAll();
        return $this->render('resources/list.twig', ['projectResources' => $projectResources]);
    }

    /**
     * @Route("/{locale}/admin/admin/resources/create", name="resources_create", requirements={"locale": "%app.locales%"})
     */
    public function createAction(Request $request)
    {
        $projectResources = new ProjectResources();
        
        /** @var Project $project */
        $project = $this->getLastProjectForCurrentUser();

        $projectResourcesForm = $this->createForm(ProjectResourcesForm::class, $projectResources, [
            'action' => $this->generateUrl('resources_create'),
            'method' => 'POST',
            'locale' => $request->getLocale(),
        ]);

        $projectResourcesForm->handleRequest($request);

        if ($projectResourcesForm->isSubmitted() && $projectResourcesForm->isValid()) {

            $projectResources->setProject($project);

            /** @var Resources $resource */
            foreach ($projectResources->getResources() as $i => $resource) {
                $file = $projectResourcesForm->get('resources')->get($i)->get('file')->getData();
                if (false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {
                    /** @var File $uploadedFile */
                    $uploadedFile = $this->get('util.file_uploader')->upload($file);

                    $fileEntity = new \AppBundle\Entity\File();
                    $fileEntity->setFile($uploadedFile->getFilename());
                    $fileEntity->setType($file->getClientOriginalExtension());
                    $fileEntity->setOriginalFileName($file->getClientOriginalName());

                    $this->getFileRepository()->save($fileEntity);

                    $resource->setFile($fileEntity);
                }

                $resource->setProjectResources($projectResources);
            }

            $this->getProjectResourcesRepository()->save($projectResources);

            return $this->redirectToRoute('intelectual_outputs_create');
        }

        return $this->render('resources/create.twig', ['my_form' => $projectResourcesForm->createView(),
            'keyAction' => $project->getKeyActions()->getNameSr(), 'projectId' => $project->getId(),
            'actionTab' => $this->showActionTab($project), 'isCompleted' => $project->getIsCompleted()]);
    }

    /**
     * @Route("/{locale}/admin/admin/resources/edit/{projectId}", name="resource_edit", requirements={"projectId": "\d+", "locale": "%app.locales%"})
     *
     */
    public function editAction(Request $request, $projectId)
    {
        /** @var ProjectResources $projectResources */
        $projectResources = $this->getProjectResourcesRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        if (count($projectResources) === 0) {
            $projectResources = new ProjectResources();
            $projectResources->setProject($project);
            $this->getProjectResourcesRepository()->save($projectResources);
        }

        $projectResourceForm = $this->createForm(ProjectResourcesForm::class, $projectResources, [
            'action' => $this->generateUrl('resource_edit', ['projectId' => $projectId]),
            'method' => 'POST',
            'locale' => $request->getLocale(),
            'isCompleted' => $project->getIsCompleted(),
        ]);

        $originalResources = new ArrayCollection();

        /** @var Resources $resource */
        foreach ($projectResources->getResources() as $i => $resource) {
            $originalResources->add($resource);

            if($resource->getFile()) {
                $file = new \Symfony\Component\HttpFoundation\File\File($this->get('util.file_uploader')->getTargetDir() . "/" . $resource->getFile()->getFile());

                $options = [
                    'file_path' => '/' . $request->getLocale() . '/project/' . $project->getId() . '/file/resource/' . $resource->getId(),
                    'file_name' => $resource->getFile()->getOriginalFileName(),
                    'mapped' => false,
                    'auto_initialize' => false,
                    'required' => false
                ];

                /** @var FormBuilder $riskLevelFormBuilder */
                $riskLevelFormBuilder = $this->get('form.factory')->createNamedBuilder('file', FileType::class, $file,
                    $options);
                $projectResourceForm->get('resources')->get($i)->remove('file');
                $projectResourceForm->get('resources')->get($i)->add($riskLevelFormBuilder->getForm());
            }
        }


        $projectResourceForm->handleRequest($request);

        if ($projectResourceForm->isSubmitted() && $projectResourceForm->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var Resources $originalResource */
            foreach ($originalResources as $originalResource) {
                if (false === $projectResources->getResources()->contains($originalResource)) {
                    $em->remove($originalResource);
                }
            }

            $resourcesToAdd = [];
            /** @var Resources $resource */
            foreach ($projectResources->getResources() as $i=>$resource) {

                if (false === $originalResources->contains($resource) || $resource->getFile() == null) {

                    $file = $projectResourceForm->get('resources')->get($i)->get('file')->getData();
                    if (false == is_null($file) && FileTypeHelper::isTypeAllowed($file)) {
                        /** @var File $uploadedFile */
                        $uploadedFile = $this->get('util.file_uploader')->upload($file);

                        $fileEntity = new \AppBundle\Entity\File();
                        $fileEntity->setFile($uploadedFile->getFilename());
                        $fileEntity->setType($file->getClientOriginalExtension());
                        $fileEntity->setOriginalFileName($file->getClientOriginalName());

                        $this->getFileRepository()->save($fileEntity);

                        $resource->setFile($fileEntity);
                    }

                    $resource->setProjectResources($projectResources);
                    $this->getProjectResourcesRepository()->save($resource);
                    $resourcesToAdd[] = $resource;
                }
            }

            $this->getResourcesRepository()->save($projectResources);
            if (!$project->getIsCompleted()) {
                return $this->redirectToRoute('intelectual_outputs_create');
            }

            return $this->redirectToRoute('resource_edit', ['locale'=> $request->getLocale(), 'projectId' => $projectId]);
        }

        return $this->render('resources/edit.twig',
            [
                'my_form' => $projectResourceForm->createView(),
                'keyAction' => $project->getKeyActions()->getNameSr(),
                'projectId' => $project->getId(),
                'isCompleted' => $project->getIsCompleted(),
                'actionTab' => $this->showActionTab($project)
            ]);
    }

    /**
     * @Route("/{locale}/admin/admin/resources/view/{projectId}", name="resource_view", requirements={"$projectId": "\d+", "locale": "%app.locales%"})
     */
    public function viewAction($projectId)
    {
        $projectResources = $this->getProjectResourcesRepository()->findOneBy(['project' => $projectId]);

        /** @var Project $project */
        $project = $this->getProjectRepository()->findOneBy(['id' => $projectId]);

        return $this->render('resources/view.twig', [
            'projectResources' => $projectResources,
            'projectId' => $projectId,
            'keyAction' => $project->getKeyActions()->getNameSr(),
            'project' => $project,
            'actionTab' => $this->showActionTab($project)
        ]);
    }

    private function getProjectResourcesRepository()
    {
        return $this->get('doctrine_entity_repository.project_resources');
    }

    private function getResourcesRepository()
    {
        return $this->get('doctrine_entity_repository.resources');
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