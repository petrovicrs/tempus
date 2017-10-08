<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use AppBundle\Entity\ProjectProgramme;
use AppBundle\Entity\ProjectKeyAction;
use AppBundle\Entity\ProjectAction;
use AppBundle\Entity\ProjectCall;
use AppBundle\Entity\ProjectRound;
use AppBundle\Entity\ProjectNote;
use AppBundle\Entity\ProjectTopic;
use AppBundle\Entity\ProjectSubjectArea;
use AppBundle\Entity\ProjectLimitation;
use AppBundle\Entity\ProjectTargetGroup;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserPermissionRepository")
 * @ORM\Table(name="user_permissions")
 */
class UserPermission extends AbstractAuditable
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectReporting",
     *      inversedBy="reporting",
     *      cascade={"persist"}
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */

    /**
     * @ORM\ManyToOne(
     *      targetEntity="UserProjectPermission"
     * )
     */
    protected $userProjectPermission;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="UserInstitutionPermission"
     * )
     */
    protected $userInstitutionPermission;

    /**
     * @ORM\Column(name="people_view", type="boolean")
     */
    protected $peopleView;

    /**
     * @ORM\Column(name="people_edit", type="boolean")
     */
    protected $peopleEdit;

    /**
     * @ORM\Column(name="people_delete", type="boolean")
     */
    protected $peopleDelete;

    /**
     * @ORM\Column(name="people_export", type="boolean")
     */
    protected $peopleExport;

    /**
     * @ORM\Column(name="activities_view", type="boolean")
     */
    protected $activitiesView;

    /**
     * @ORM\Column(name="activities_edit", type="boolean")
     */
    protected $activitiesEdit;

    /**
     * @ORM\Column(name="activities_delete", type="boolean")
     */
    protected $activitiesDelete;

    /**
     * @ORM\Column(name="activities_export", type="boolean")
     */
    protected $activitiesExport;

    /**
     * @ORM\Column(name="deliverables_view", type="boolean")
     */
    protected $deliverablesView;

    /**
     * @ORM\Column(name="deliverables_edit", type="boolean")
     */
    protected $deliverablesEdit;

    /**
     * @ORM\Column(name="deliverables_delete", type="boolean")
     */
    protected $deliverablesDelete;

    /**
     * @ORM\Column(name="deliverables_export", type="boolean")
     */
    protected $deliverablesExport;

    /**
     * @ORM\Column(name="monitoring_view", type="boolean")
     */
    protected $monitoringView;

    /**
     * @ORM\Column(name="monitoring_edit", type="boolean")
     */
    protected $monitoringEdit;

    /**
     * @ORM\Column(name="monitoring_delete", type="boolean")
     */
    protected $monitoringDelete;

    /**
     * @ORM\Column(name="monitoring_export", type="boolean")
     */
    protected $monitoringExport;

    /**
     * @ORM\Column(name="partners_view", type="boolean")
     */
    protected $partnersView;

    /**
     * @ORM\Column(name="partners_edit", type="boolean")
     */
    protected $partnersEdit;

    /**
     * @ORM\Column(name="partners_delete", type="boolean")
     */
    protected $partnersDelete;

    /**
     * @ORM\Column(name="partners_export", type="boolean")
     */
    protected $partnersExport;

    /**
     * @ORM\Column(name="resources_view", type="boolean")
     */
    protected $resourcesView;

    /**
     * @ORM\Column(name="resources_edit", type="boolean")
     */
    protected $resourcesEdit;

    /**
     * @ORM\Column(name="resources_delete", type="boolean")
     */
    protected $resourcesDelete;

    /**
     * @ORM\Column(name="resources_export", type="boolean")
     */
    protected $resourcesExport;

    /**
     * @ORM\Column(name="intoutputs_view", type="boolean")
     */
    protected $intoutputsView;

    /**
     * @ORM\Column(name="intoutputs_edit", type="boolean")
     */
    protected $intoutputsEdit;

    /**
     * @ORM\Column(name="intoutputs_delete", type="boolean")
     */
    protected $intoutputsDelete;

    /**
     * @ORM\Column(name="intoutputs_export", type="boolean")
     */
    protected $intoutputsExport;

    /**
     * @ORM\Column(name="results_view", type="boolean")
     */
    protected $resultsView;

    /**
     * @ORM\Column(name="results_edit", type="boolean")
     */
    protected $resultsEdit;

    /**
     * @ORM\Column(name="results_delete", type="boolean")
     */
    protected $resultsDelete;

    /**
     * @ORM\Column(name="results_export", type="boolean")
     */
    protected $resultsExport;

    /**
     * @ORM\Column(name="reporting_view", type="boolean")
     */
    protected $reportingView;

    /**
     * @ORM\Column(name="reporting_edit", type="boolean")
     */
    protected $reportingEdit;

    /**
     * @ORM\Column(name="reporting_delete", type="boolean")
     */
    protected $reportingDelete;

    /**
     * @ORM\Column(name="reporting_export", type="boolean")
     */
    protected $reportingExport;

    /**
     * @ORM\Column(name="attachments_view", type="boolean")
     */
    protected $attachmentsView;

    /**
     * @ORM\Column(name="attachments_edit", type="boolean")
     */
    protected $attachmentsEdit;

    /**
     * @ORM\Column(name="attachments_delete", type="boolean")
     */
    protected $attachmentsDelete;

    /**
     * @ORM\Column(name="attachments_export", type="boolean")
     */
    protected $attachmentsExport;

    /**
     * @ORM\Column(name="calendar_view", type="boolean")
     */
    protected $calendarView;

    /**
     * @ORM\Column(name="calendar_edit", type="boolean")
     */
    protected $calendarEdit;

    /**
     * @ORM\Column(name="calendar_delete", type="boolean")
     */
    protected $calendarDelete;

    /**
     * @ORM\Column(name="calendar_export", type="boolean")
     */
    protected $calendarExport;

    /**
     * @ORM\Column(name="users_view", type="boolean")
     */
    protected $usersView;

    /**
     * @ORM\Column(name="users_edit", type="boolean")
     */
    protected $usersEdit;

    /**
     * @ORM\Column(name="users_delete", type="boolean")
     */
    protected $usersDelete;

    /**
     * @ORM\Column(name="users_export", type="boolean")
     */
    protected $usersExport;

    /**
     * @ORM\Column(name="newproject_view", type="boolean")
     */
    protected $newprojectView;

    /**
     * @ORM\Column(name="newproject_edit", type="boolean")
     */
    protected $newprojectEdit;

    /**
     * @ORM\Column(name="newproject_delete", type="boolean")
     */
    protected $newprojectDelete;

    /**
     * @ORM\Column(name="newproject_create", type="boolean")
     */
    protected $newprojectCreate;

    /**
     * @ORM\Column(name="newproject_export", type="boolean")
     */
    protected $newprojectExport;

    /**
     * @ORM\Column(name="newinstitution_view", type="boolean")
     */
    protected $newinstitutionView;

    /**
     * @ORM\Column(name="newinstitution_edit", type="boolean")
     */
    protected $newinstitutionEdit;

    /**
     * @ORM\Column(name="newinstitution_delete", type="boolean")
     */
    protected $newinstitutionDelete;

    /**
     * @ORM\Column(name="newinstitution_export", type="boolean")
     */
    protected $newinstitutionExport;

    /**
     * @ORM\Column(name="newinstitution_create", type="boolean")
     */
    protected $newinstitutionCreate;

    public function __construct()
    {
        parent::__construct();
        $this->userInstitutionPermission = new ArrayCollection();
        $this->userProjectPermission = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserProjectPermission()
    {
        return $this->userProjectPermission;
    }

    /**
     * @param mixed $userProjectPermission
     */
    public function setUserProjectPermission($userProjectPermission)
    {
        $this->userProjectPermission = $userProjectPermission;
    }

    /**
     * @return mixed
     */
    public function getUserInstitutionPermission()
    {
        return $this->userInstitutionPermission;
    }

    /**
     * @param mixed $userInstitutionPermission
     */
    public function setUserInstitutionPermission($userInstitutionPermission)
    {
        $this->userInstitutionPermission = $userInstitutionPermission;
    }

    /**
     * @return mixed
     */
    public function getPeopleView()
    {
        return $this->peopleView;
    }

    /**
     * @param mixed $peopleView
     */
    public function setPeopleView($peopleView)
    {
        $this->peopleView = $peopleView;
    }

    /**
     * @return mixed
     */
    public function getPeopleEdit()
    {
        return $this->peopleEdit;
    }

    /**
     * @param mixed $peopleEdit
     */
    public function setPeopleEdit($peopleEdit)
    {
        $this->peopleEdit = $peopleEdit;
    }

    /**
     * @return mixed
     */
    public function getPeopleDelete()
    {
        return $this->peopleDelete;
    }

    /**
     * @param mixed $peopleDelete
     */
    public function setPeopleDelete($peopleDelete)
    {
        $this->peopleDelete = $peopleDelete;
    }

    /**
     * @return mixed
     */
    public function getPeopleExport()
    {
        return $this->peopleExport;
    }

    /**
     * @param mixed $peopleExport
     */
    public function setPeopleExport($peopleExport)
    {
        $this->peopleExport = $peopleExport;
    }

    /**
     * @return mixed
     */
    public function getActivitiesView()
    {
        return $this->activitiesView;
    }

    /**
     * @param mixed $activitiesView
     */
    public function setActivitiesView($activitiesView)
    {
        $this->activitiesView = $activitiesView;
    }

    /**
     * @return mixed
     */
    public function getActivitiesEdit()
    {
        return $this->activitiesEdit;
    }

    /**
     * @param mixed $activitiesEdit
     */
    public function setActivitiesEdit($activitiesEdit)
    {
        $this->activitiesEdit = $activitiesEdit;
    }

    /**
     * @return mixed
     */
    public function getActivitiesDelete()
    {
        return $this->activitiesDelete;
    }

    /**
     * @param mixed $activitiesDelete
     */
    public function setActivitiesDelete($activitiesDelete)
    {
        $this->activitiesDelete = $activitiesDelete;
    }

    /**
     * @return mixed
     */
    public function getActivitiesExport()
    {
        return $this->activitiesExport;
    }

    /**
     * @param mixed $activitiesExport
     */
    public function setActivitiesExport($activitiesExport)
    {
        $this->activitiesExport = $activitiesExport;
    }

    /**
     * @return mixed
     */
    public function getDeliverablesView()
    {
        return $this->deliverablesView;
    }

    /**
     * @param mixed $deliverablesView
     */
    public function setDeliverablesView($deliverablesView)
    {
        $this->deliverablesView = $deliverablesView;
    }

    /**
     * @return mixed
     */
    public function getDeliverablesEdit()
    {
        return $this->deliverablesEdit;
    }

    /**
     * @param mixed $deliverablesEdit
     */
    public function setDeliverablesEdit($deliverablesEdit)
    {
        $this->deliverablesEdit = $deliverablesEdit;
    }

    /**
     * @return mixed
     */
    public function getDeliverablesDelete()
    {
        return $this->deliverablesDelete;
    }

    /**
     * @param mixed $deliverablesDelete
     */
    public function setDeliverablesDelete($deliverablesDelete)
    {
        $this->deliverablesDelete = $deliverablesDelete;
    }

    /**
     * @return mixed
     */
    public function getDeliverablesExport()
    {
        return $this->deliverablesExport;
    }

    /**
     * @param mixed $deliverablesExport
     */
    public function setDeliverablesExport($deliverablesExport)
    {
        $this->deliverablesExport = $deliverablesExport;
    }

    /**
     * @return mixed
     */
    public function getMonitoringView()
    {
        return $this->monitoringView;
    }

    /**
     * @param mixed $monitoringView
     */
    public function setMonitoringView($monitoringView)
    {
        $this->monitoringView = $monitoringView;
    }

    /**
     * @return mixed
     */
    public function getMonitoringEdit()
    {
        return $this->monitoringEdit;
    }

    /**
     * @param mixed $monitoringEdit
     */
    public function setMonitoringEdit($monitoringEdit)
    {
        $this->monitoringEdit = $monitoringEdit;
    }

    /**
     * @return mixed
     */
    public function getMonitoringDelete()
    {
        return $this->monitoringDelete;
    }

    /**
     * @param mixed $monitoringDelete
     */
    public function setMonitoringDelete($monitoringDelete)
    {
        $this->monitoringDelete = $monitoringDelete;
    }

    /**
     * @return mixed
     */
    public function getMonitoringExport()
    {
        return $this->monitoringExport;
    }

    /**
     * @param mixed $monitoringExport
     */
    public function setMonitoringExport($monitoringExport)
    {
        $this->monitoringExport = $monitoringExport;
    }

    /**
     * @return mixed
     */
    public function getPartnersView()
    {
        return $this->partnersView;
    }

    /**
     * @param mixed $partnersView
     */
    public function setPartnersView($partnersView)
    {
        $this->partnersView = $partnersView;
    }

    /**
     * @return mixed
     */
    public function getPartnersEdit()
    {
        return $this->partnersEdit;
    }

    /**
     * @param mixed $partnersEdit
     */
    public function setPartnersEdit($partnersEdit)
    {
        $this->partnersEdit = $partnersEdit;
    }

    /**
     * @return mixed
     */
    public function getPartnersDelete()
    {
        return $this->partnersDelete;
    }

    /**
     * @param mixed $partnersDelete
     */
    public function setPartnersDelete($partnersDelete)
    {
        $this->partnersDelete = $partnersDelete;
    }

    /**
     * @return mixed
     */
    public function getPartnersExport()
    {
        return $this->partnersExport;
    }

    /**
     * @param mixed $partnersExport
     */
    public function setPartnersExport($partnersExport)
    {
        $this->partnersExport = $partnersExport;
    }

    /**
     * @return mixed
     */
    public function getResourcesView()
    {
        return $this->resourcesView;
    }

    /**
     * @param mixed $resourcesView
     */
    public function setResourcesView($resourcesView)
    {
        $this->resourcesView = $resourcesView;
    }

    /**
     * @return mixed
     */
    public function getResourcesEdit()
    {
        return $this->resourcesEdit;
    }

    /**
     * @param mixed $resourcesEdit
     */
    public function setResourcesEdit($resourcesEdit)
    {
        $this->resourcesEdit = $resourcesEdit;
    }

    /**
     * @return mixed
     */
    public function getResourcesDelete()
    {
        return $this->resourcesDelete;
    }

    /**
     * @param mixed $resourcesDelete
     */
    public function setResourcesDelete($resourcesDelete)
    {
        $this->resourcesDelete = $resourcesDelete;
    }

    /**
     * @return mixed
     */
    public function getResourcesExport()
    {
        return $this->resourcesExport;
    }

    /**
     * @param mixed $resourcesExport
     */
    public function setResourcesExport($resourcesExport)
    {
        $this->resourcesExport = $resourcesExport;
    }

    /**
     * @return mixed
     */
    public function getIntoutputsView()
    {
        return $this->intoutputsView;
    }

    /**
     * @param mixed $intoutputsView
     */
    public function setIntoutputsView($intoutputsView)
    {
        $this->intoutputsView = $intoutputsView;
    }

    /**
     * @return mixed
     */
    public function getIntoutputsEdit()
    {
        return $this->intoutputsEdit;
    }

    /**
     * @param mixed $intoutputsEdit
     */
    public function setIntoutputsEdit($intoutputsEdit)
    {
        $this->intoutputsEdit = $intoutputsEdit;
    }

    /**
     * @return mixed
     */
    public function getIntoutputsDelete()
    {
        return $this->intoutputsDelete;
    }

    /**
     * @param mixed $intoutputsDelete
     */
    public function setIntoutputsDelete($intoutputsDelete)
    {
        $this->intoutputsDelete = $intoutputsDelete;
    }

    /**
     * @return mixed
     */
    public function getIntoutputsExport()
    {
        return $this->intoutputsExport;
    }

    /**
     * @param mixed $intoutputsExport
     */
    public function setIntoutputsExport($intoutputsExport)
    {
        $this->intoutputsExport = $intoutputsExport;
    }

    /**
     * @return mixed
     */
    public function getResultsView()
    {
        return $this->resultsView;
    }

    /**
     * @param mixed $resultsView
     */
    public function setResultsView($resultsView)
    {
        $this->resultsView = $resultsView;
    }

    /**
     * @return mixed
     */
    public function getResultsEdit()
    {
        return $this->resultsEdit;
    }

    /**
     * @param mixed $resultsEdit
     */
    public function setResultsEdit($resultsEdit)
    {
        $this->resultsEdit = $resultsEdit;
    }

    /**
     * @return mixed
     */
    public function getResultsDelete()
    {
        return $this->resultsDelete;
    }

    /**
     * @param mixed $resultsDelete
     */
    public function setResultsDelete($resultsDelete)
    {
        $this->resultsDelete = $resultsDelete;
    }

    /**
     * @return mixed
     */
    public function getResultsExport()
    {
        return $this->resultsExport;
    }

    /**
     * @param mixed $resultsExport
     */
    public function setResultsExport($resultsExport)
    {
        $this->resultsExport = $resultsExport;
    }

    /**
     * @return mixed
     */
    public function getReportingView()
    {
        return $this->reportingView;
    }

    /**
     * @param mixed $reportingView
     */
    public function setReportingView($reportingView)
    {
        $this->reportingView = $reportingView;
    }

    /**
     * @return mixed
     */
    public function getReportingEdit()
    {
        return $this->reportingEdit;
    }

    /**
     * @param mixed $reportingEdit
     */
    public function setReportingEdit($reportingEdit)
    {
        $this->reportingEdit = $reportingEdit;
    }

    /**
     * @return mixed
     */
    public function getReportingDelete()
    {
        return $this->reportingDelete;
    }

    /**
     * @param mixed $reportingDelete
     */
    public function setReportingDelete($reportingDelete)
    {
        $this->reportingDelete = $reportingDelete;
    }

    /**
     * @return mixed
     */
    public function getReportingExport()
    {
        return $this->reportingExport;
    }

    /**
     * @param mixed $reportingExport
     */
    public function setReportingExport($reportingExport)
    {
        $this->reportingExport = $reportingExport;
    }

    /**
     * @return mixed
     */
    public function getAttachmentsView()
    {
        return $this->attachmentsView;
    }

    /**
     * @param mixed $attachmentsView
     */
    public function setAttachmentsView($attachmentsView)
    {
        $this->attachmentsView = $attachmentsView;
    }

    /**
     * @return mixed
     */
    public function getAttachmentsEdit()
    {
        return $this->attachmentsEdit;
    }

    /**
     * @param mixed $attachmentsEdit
     */
    public function setAttachmentsEdit($attachmentsEdit)
    {
        $this->attachmentsEdit = $attachmentsEdit;
    }

    /**
     * @return mixed
     */
    public function getAttachmentsDelete()
    {
        return $this->attachmentsDelete;
    }

    /**
     * @param mixed $attachmentsDelete
     */
    public function setAttachmentsDelete($attachmentsDelete)
    {
        $this->attachmentsDelete = $attachmentsDelete;
    }

    /**
     * @return mixed
     */
    public function getAttachmentsExport()
    {
        return $this->attachmentsExport;
    }

    /**
     * @param mixed $attachmentsExport
     */
    public function setAttachmentsExport($attachmentsExport)
    {
        $this->attachmentsExport = $attachmentsExport;
    }

    /**
     * @return mixed
     */
    public function getCalendarView()
    {
        return $this->calendarView;
    }

    /**
     * @param mixed $calendarView
     */
    public function setCalendarView($calendarView)
    {
        $this->calendarView = $calendarView;
    }

    /**
     * @return mixed
     */
    public function getCalendarEdit()
    {
        return $this->calendarEdit;
    }

    /**
     * @param mixed $calendarEdit
     */
    public function setCalendarEdit($calendarEdit)
    {
        $this->calendarEdit = $calendarEdit;
    }

    /**
     * @return mixed
     */
    public function getCalendarDelete()
    {
        return $this->calendarDelete;
    }

    /**
     * @param mixed $calendarDelete
     */
    public function setCalendarDelete($calendarDelete)
    {
        $this->calendarDelete = $calendarDelete;
    }

    /**
     * @return mixed
     */
    public function getCalendarExport()
    {
        return $this->calendarExport;
    }

    /**
     * @param mixed $calendarExport
     */
    public function setCalendarExport($calendarExport)
    {
        $this->calendarExport = $calendarExport;
    }

    /**
     * @return mixed
     */
    public function getUsersView()
    {
        return $this->usersView;
    }

    /**
     * @param mixed $usersView
     */
    public function setUsersView($usersView)
    {
        $this->usersView = $usersView;
    }

    /**
     * @return mixed
     */
    public function getUsersEdit()
    {
        return $this->usersEdit;
    }

    /**
     * @param mixed $usersEdit
     */
    public function setUsersEdit($usersEdit)
    {
        $this->usersEdit = $usersEdit;
    }

    /**
     * @return mixed
     */
    public function getUsersDelete()
    {
        return $this->usersDelete;
    }

    /**
     * @param mixed $usersDelete
     */
    public function setUsersDelete($usersDelete)
    {
        $this->usersDelete = $usersDelete;
    }

    /**
     * @return mixed
     */
    public function getUsersExport()
    {
        return $this->usersExport;
    }

    /**
     * @param mixed $usersExport
     */
    public function setUsersExport($usersExport)
    {
        $this->usersExport = $usersExport;
    }

    /**
     * @return mixed
     */
    public function getNewprojectView()
    {
        return $this->newprojectView;
    }

    /**
     * @param mixed $newprojectView
     */
    public function setNewprojectView($newprojectView)
    {
        $this->newprojectView = $newprojectView;
    }

    /**
     * @return mixed
     */
    public function getNewprojectEdit()
    {
        return $this->newprojectEdit;
    }

    /**
     * @param mixed $newprojectEdit
     */
    public function setNewprojectEdit($newprojectEdit)
    {
        $this->newprojectEdit = $newprojectEdit;
    }

    /**
     * @return mixed
     */
    public function getNewprojectDelete()
    {
        return $this->newprojectDelete;
    }

    /**
     * @param mixed $newprojectDelete
     */
    public function setNewprojectDelete($newprojectDelete)
    {
        $this->newprojectDelete = $newprojectDelete;
    }

    /**
     * @return mixed
     */
    public function getNewprojectCreate()
    {
        return $this->newprojectCreate;
    }

    /**
     * @param mixed $newprojectCreate
     */
    public function setNewprojectCreate($newprojectCreate)
    {
        $this->newprojectCreate = $newprojectCreate;
    }

    /**
     * @return mixed
     */
    public function getNewprojectExport()
    {
        return $this->newprojectExport;
    }

    /**
     * @param mixed $newprojectExport
     */
    public function setNewprojectExport($newprojectExport)
    {
        $this->newprojectExport = $newprojectExport;
    }

    /**
     * @return mixed
     */
    public function getNewinstitutionView()
    {
        return $this->newinstitutionView;
    }

    /**
     * @param mixed $newinstitutionView
     */
    public function setNewinstitutionView($newinstitutionView)
    {
        $this->newinstitutionView = $newinstitutionView;
    }

    /**
     * @return mixed
     */
    public function getNewinstitutionEdit()
    {
        return $this->newinstitutionEdit;
    }

    /**
     * @param mixed $newinstitutionEdit
     */
    public function setNewinstitutionEdit($newinstitutionEdit)
    {
        $this->newinstitutionEdit = $newinstitutionEdit;
    }

    /**
     * @return mixed
     */
    public function getNewinstitutionDelete()
    {
        return $this->newinstitutionDelete;
    }

    /**
     * @param mixed $newinstitutionDelete
     */
    public function setNewinstitutionDelete($newinstitutionDelete)
    {
        $this->newinstitutionDelete = $newinstitutionDelete;
    }

    /**
     * @return mixed
     */
    public function getNewinstitutionExport()
    {
        return $this->newinstitutionExport;
    }

    /**
     * @param mixed $newinstitutionExport
     */
    public function setNewinstitutionExport($newinstitutionExport)
    {
        $this->newinstitutionExport = $newinstitutionExport;
    }

    /**
     * @return mixed
     */
    public function getNewinstitutionCreate()
    {
        return $this->newinstitutionCreate;
    }

    /**
     * @param mixed $newinstitutionCreate
     */
    public function setNewinstitutionCreate($newinstitutionCreate)
    {
        $this->newinstitutionCreate = $newinstitutionCreate;
    }

}

