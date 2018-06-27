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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectRepository")
 * @ORM\Table(name="projects")
 */
class Project extends AbstractAuditable
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
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $user;

    /**
     * @var string $nameEn
     * @Assert\Type("string")
     * @ORM\Column(name="name_eng", type="string", length=255, nullable=true)
     */
    protected $nameEn;

    /**
     * @var string $nameSr
     * @Assert\Type("string")
     * @ORM\Column(name="name_srb", type="string", length=255, nullable=true)
     */
    protected $nameSr;

    /**
     * @var string $nameOriginalLetter
     * @Assert\Type("string")
     * @ORM\Column(name="name_original_letter", type="string", length=255, nullable=true)
     */
    protected $nameOriginalLetter;

    /**
     * @var string $acronym
     * @Assert\Type("string")
     * @ORM\Column(name="acronym", type="string", length=255, nullable=true)
     */
    protected $acronym;

    /**
     * @var string $projectNumber
     * @Assert\Type("string")
     * @ORM\Column(name="project_number", type="string", length=255, nullable=true)
     */
    protected $projectNumber;

    /**
     * @var string $projectSummary
     * @Assert\Type("string")
     * @ORM\Column(name="project_summary", type="text", nullable=true)
     */
    protected $projectSummary;

    /**
     * @var string $applicationYear
     * @Assert\Type("string")
     * @ORM\Column(name="application_year", type="string", length=255, nullable=true)
     */
    protected $applicationYear;

    /**
     * @var string $website
     * @Assert\Type("string")
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    protected $website;

    /**
     * @var string $projectGrant
     * @Assert\Type("string")
     * @ORM\Column(name="projectGrant", type="string", length=255, nullable=true)
     */
    protected $projectGrant;

    /**
     * @var string $cofinancing
     * @Assert\Type("string")
     * @ORM\Column(name="cofinancing", type="string", length=255, nullable=true)
     */
    protected $cofinancing;

    /**
     * @var string $total
     * @Assert\Type("string")
     * @ORM\Column(name="total", type="string", length=255, nullable=true)
     */
    protected $total;

    /**
     * @var string $remarkOfficer
     * @Assert\Type("string")
     * @ORM\Column(name="remarkOfficer", type="string", length=255, nullable=true)
     */
    protected $remarkOfficer;

    /**
     * @var string $remarkGrade
     * @Assert\Type("string")
     * @ORM\Column(name="remarkGrade", type="string", length=255, nullable=true)
     */
    protected $remarkGrade;

    /**
     * @var string $projectSummaryEnglish
     * @Assert\Type("string")
     * @ORM\Column(name="projectSummaryEnglish", type="text", nullable=true)
     */
    protected $projectSummaryEnglish;

    /**
     * @var string $projectSummarySerbian
     * @Assert\Type("string")
     * @ORM\Column(name="projectSummarySerbian", type="text", nullable=true)
     */
    protected $projectSummarySerbian;

    /**
     * @var string $projectSummaryNative
     * @Assert\Type("string")
     * @ORM\Column(name="projectSummaryNative", type="text", nullable=true)
     */
    protected $projectSummaryNative;

    /**
     * @var string $projectObjectivesEnglish
     * @Assert\Type("string")
     * @ORM\Column(name="projectObjectivesEnglish", type="text", nullable=true)
     */
    protected $projectObjectivesEnglish;

    /**
     * @var string $projectObjectivesSerbian
     * @Assert\Type("string")
     * @ORM\Column(name="projectObjectivesSerbian", type="text", nullable=true)
     */
    protected $projectObjectivesSerbian;

    /**
     * @var string $projectObjectivesNative
     * @Assert\Type("string")
     * @ORM\Column(name="projectObjectivesNative", type="text", nullable=true)
     */
    protected $projectObjectivesNative;

    /**
     * @ORM\Column(name="end_datetime", type="date", nullable=true)
     */
    protected $endDatetime;

    /**
     * @ORM\Column(name="start_datetime", type="date", nullable=true)
     */
    protected $startDatetime;

    /**
     * @ORM\Column(name="extended_until", type="date", nullable=true)
     */
    protected $extendedUntil;

    /**
    * @var integer $durationMonths
    * @Assert\Type("numeric")
    * @Column(type="integer", name="duration_months", options={"unsigned":true}, nullable=true)
    */
    protected $durationMonths;

    /**
     * @ORM\Column(name="audited", type="boolean", nullable=true)
     */
    protected $audited;

    /**
     * @ORM\Column(name="on_going", type="boolean", nullable=true)
     */
    protected $onGoing;

    /**
     * @ORM\Column(name="published", type="boolean", nullable=true)
     */
    protected $published;

    /**
     * @ORM\Column(name="participant_fewer_options", type="boolean", nullable=true)
     */
    protected $participantFewerOptions;

    /**
     * @ORM\Column(name="consortium", type="boolean", nullable=true)
     */
    protected $consortium;

    /**
     * @ORM\Column(name="is_completed", type="integer", nullable=true)
     */
    protected $isCompleted;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectProgramme"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $programmes;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectKeyAction"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $keyActions;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectAction"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $actions;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $types;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="Person"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $contactPersonKa2;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectCall"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $calls;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectRound"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $rounds;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $ftOfficers;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $eaceaOfficers;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="HorizontalPriorityType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $horizontalPriorityType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="VerticalPriorityType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $verticalPriorityType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectStatusType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectStatusType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectGradeType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectGradeType;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectScopeType"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $projectScopeType;

    /**
     * @ORM\OneToMany(targetEntity="ProjectNote", mappedBy="project", cascade={"persist"})
     */
    protected $notes;

    /**
     * @ORM\OneToMany(targetEntity="ProjectApplicantOrganisation", mappedBy="project", cascade={"persist"})
     */
    protected $applicantOrganisations;

    /**
     * @ORM\OneToMany(targetEntity="ProjectPartnerOrganisation", mappedBy="project", cascade={"persist"})
     */
    protected $partnerOrganisations;

    /**
     * @ORM\OneToMany(targetEntity="ProjectLimitation", mappedBy="project", cascade={"persist"})
     */
    protected $limitations;

    /**
     * @ORM\OneToMany(targetEntity="ProjectContactPerson", mappedBy="project", cascade={"persist"})
     */
    protected $contactPersons;

    /**
     * @ORM\OneToMany(targetEntity="ProjectTopic", mappedBy="project", cascade={"persist"})
     */
    protected $topics;

    /**
     * @ORM\OneToMany(targetEntity="ProjectSubjectArea", mappedBy="project", cascade={"persist"})
     */
    protected $subjectAreas;

    /**
     * @ORM\OneToMany(targetEntity="ProjectTargetGroup", mappedBy="project", cascade={"persist"})
     */
    protected $projectTargetGroup;

    /**
     * @ORM\OneToMany(targetEntity="DifficultiesParticipantsAreFacing", mappedBy="project", cascade={"persist"})
     */
    protected $difficultiesParticipantsAreFacing;

    /**
     * @ORM\OneToMany(targetEntity="ProjectPriority", mappedBy="project", cascade={"persist"})
     */
    protected $projectPriority;

    /**
     * @ORM\OneToMany(targetEntity="ProjectContact", mappedBy="project", cascade={"persist"})
     */
    protected $contacts;

    public function __construct()
    {
        parent::__construct();
        $this->subjectAreas = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->contactPersons = new ArrayCollection();
        $this->limitations = new ArrayCollection();
        $this->partnerOrganisations = new ArrayCollection();
        $this->applicantOrganisations = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->projectTargetGroup = new ArrayCollection();
        $this->projectPriority = new ArrayCollection();
        $this->contacts = new ArrayCollection();
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getNameEn()
    {
        return $this->nameEn;
    }

    /**
     * @param string $nameEn
     */
    public function setNameEn($nameEn)
    {
        $this->nameEn = $nameEn;
    }

    /**
     * @return string
     */
    public function getNameSr()
    {
        return $this->nameSr;
    }

    /**
     * @param string $nameSr
     */
    public function setNameSr($nameSr)
    {
        $this->nameSr = $nameSr;
    }

    /**
     * @return string
     */
    public function getNameOriginalLetter()
    {
        return $this->nameOriginalLetter;
    }

    /**
     * @param string $nameOriginalLetter
     */
    public function setNameOriginalLetter($nameOriginalLetter)
    {
        $this->nameOriginalLetter = $nameOriginalLetter;
    }

    /**
     * @return string
     */
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * @param string $acronym
     */
    public function setAcronym($acronym)
    {
        $this->acronym = $acronym;
    }

    /**
     * @return string
     */
    public function getProjectNumber()
    {
        return $this->projectNumber;
    }

    /**
     * @param string $projectNumber
     */
    public function setProjectNumber($projectNumber)
    {
        $this->projectNumber = $projectNumber;
    }

    /**
     * @return string
     */
    public function getProjectSummary()
    {
        return $this->projectSummary;
    }

    /**
     * @param string $projectSummary
     */
    public function setProjectSummary($projectSummary)
    {
        $this->projectSummary = $projectSummary;
    }

    /**
     * @return mixed
     */
    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

    /**
     * @param mixed $endDatetime
     */
    public function setEndDatetime($endDatetime)
    {
        $this->endDatetime = $endDatetime;
    }

    /**
     * @return mixed
     */
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    /**
     * @param mixed $startDatetime
     */
    public function setStartDatetime($startDatetime)
    {
        $this->startDatetime = $startDatetime;
    }

    /**
     * @return mixed
     */
    public function getExtendedUntil()
    {
        return $this->extendedUntil;
    }

    /**
     * @param mixed $extendedUntil
     */
    public function setExtendedUntil($extendedUntil)
    {
        $this->extendedUntil = $extendedUntil;
    }

    /**
     * @return int
     */
    public function getDurationMonths()
    {
        return $this->durationMonths;
    }

    /**
     * @param int $durationMonths
     */
    public function setDurationMonths($durationMonths)
    {
        $this->durationMonths = $durationMonths;
    }

    /**
     * @return mixed
     */
    public function getAudited()
    {
        return $this->audited;
    }

    /**
     * @param mixed $audited
     */
    public function setAudited($audited)
    {
        $this->audited = $audited;
    }

    /**
     * @return mixed
     */
    public function getOnGoing()
    {
        return $this->onGoing;
    }

    /**
     * @param mixed $onGoing
     */
    public function setOnGoing($onGoing)
    {
        $this->onGoing = $onGoing;
    }

    /**
     * @return mixed
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * @param mixed $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * @return mixed
     */
    public function getParticipantFewerOptions()
    {
        return $this->participantFewerOptions;
    }

    /**
     * @param mixed $participantFewerOptions
     */
    public function setParticipantFewerOptions($participantFewerOptions)
    {
        $this->participantFewerOptions = $participantFewerOptions;
    }

    /**
     * @return mixed
     */
    public function getConsortium()
    {
        return $this->consortium;
    }

    /**
     * @param mixed $consortium
     */
    public function setConsortium($consortium)
    {
        $this->consortium = $consortium;
    }

    /**
     * @return mixed
     */
    public function getFtOfficers()
    {
        return $this->ftOfficers;
    }

    /**
     * @param mixed $ftOfficers
     */
    public function setFtOfficers($ftOfficers)
    {
        $this->ftOfficers = $ftOfficers;
    }

    /**
     * @return mixed
     */
    public function getEaceaOfficers()
    {
        return $this->eaceaOfficers;
    }

    /**
     * @param mixed $eaceaOfficers
     */
    public function setEaceaOfficers($eaceaOfficers)
    {
        $this->eaceaOfficers = $eaceaOfficers;
    }

    /**
     * @return mixed
     */
    public function getProgrammes()
    {
        return $this->programmes;
    }

    /**
     * @param mixed $programmes
     */
    public function setProgrammes($programmes)
    {
        $this->programmes = $programmes;
    }

    /**
     * @return mixed
     */
    public function getKeyActions()
    {
        return $this->keyActions;
    }

    /**
     * @param mixed $keyActions
     */
    public function setKeyActions($keyActions)
    {
        $this->keyActions = $keyActions;
    }

    /**
     * @return mixed
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * @param mixed $actions
     */
    public function setActions($actions)
    {
        $this->actions = $actions;
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($type)
    {
        $this->types = $type;
    }

    /**
     * @return mixed
     */
    public function getCalls()
    {
        return $this->calls;
    }

    /**
     * @param mixed $calls
     */
    public function setCalls($calls)
    {
        $this->calls = $calls;
    }

    /**
     * @return mixed
     */
    public function getRounds()
    {
        return $this->rounds;
    }

    /**
     * @param mixed $rounds
     */
    public function setRounds($rounds)
    {
        $this->rounds = $rounds;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function addNotes(ProjectNote $note)
    {
        $this->notes->add($note);
    }

    public function removeNotes(ProjectNote $note)
    {
        $this->notes->removeElement($note);
    }

    /**
     * @return mixed
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param mixed $contacts
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;
    }

    public function addContacts(ProjectContact $contact)
    {
        $this->notes->add($contact);
    }

    public function removeContacts(ProjectContact $contact)
    {
        $this->notes->removeElement($contact);
    }

    /**
     * @return mixed
     */
    public function getApplicantOrganisations()
    {
        return $this->applicantOrganisations;
    }

    /**
     * @param mixed $applicantOrganisation
     */
    public function setApplicantOrganisations($applicantOrganisation)
    {
        $this->applicantOrganisations = $applicantOrganisation;
    }

    public function addApplicantOrganisations(ProjectApplicantOrganisation $applicantOrganisation)
    {
        $this->applicantOrganisations->add($applicantOrganisation);
    }

    public function removeApplicantOrganisations(ProjectApplicantOrganisation $applicantOrganisation)
    {
        $this->applicantOrganisations->removeElement($applicantOrganisation);
    }

    /**
     * @return mixed
     */
    public function getPartnerOrganisations()
    {
        return $this->partnerOrganisations;
    }

    /**
     * @param mixed $partnerOrganisations
     */
    public function setPartnerOrganisations($partnerOrganisations)
    {
        $this->partnerOrganisations = $partnerOrganisations;
    }

    public function addPartnerOrganisations(ProjectPartnerOrganisation $partnerOrganisation)
    {
        $this->partnerOrganisations->add($partnerOrganisation);
    }

    public function removePartnerOrganisations(ProjectPartnerOrganisation $partnerOrganisation)
    {
        $this->partnerOrganisations->removeElement($partnerOrganisation);
    }

    /**
     * @return mixed
     */
    public function getLimitations()
    {
        return $this->limitations;
    }

    /**
     * @param mixed $limitations
     */
    public function setLimitations($limitation)
    {
        $this->limitations = $limitation;
    }

    public function addLimitations(ProjectLimitation $limitation)
    {
        $this->limitations->add($limitation);
    }

    public function removeLimitations(ProjectLimitation $limitation)
    {
        $this->limitations->removeElement($limitation);
    }

    /**
     * @return mixed
     */
    public function getContactPersons()
    {
        return $this->contactPersons;
    }

    /**
     * @param mixed $contactPersons
     */
    public function setContactPersons($contactPersons)
    {
        $this->contactPersons = $contactPersons;
    }

    public function addContactPersons(PicNumber $contactPerson)
    {
        $this->contactPersons->add($contactPerson);
    }

    public function removeContactPersons(PicNumber $contactPerson)
    {
        $this->contactPersons->removeElement($contactPerson);
    }

    /**
     * @return mixed
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @param mixed $topics
     */
    public function setTopics($topics)
    {
        $this->topics = $topics;
    }

    public function addTopics(ProjectTopic $topic)
    {
        $this->topics->add($topic);
    }

    public function removeTopics(ProjectTopic $topic)
    {
        $this->topics->removeElement($topic);
    }

    /**
     * @return mixed
     */
    public function getProjectTargetGroup()
    {
        return $this->projectTargetGroup;
    }

    /**
     * @param mixed $projectTargetGroup
     */
    public function setProjectTargetGroup($projectTargetGroup)
    {
        $this->projectTargetGroup = $projectTargetGroup;
    }

    public function addProjectTargetGroup(ProjectTargetGroup $group)
    {
        $this->projectTargetGroup->add($group);
    }

    public function removeProjectTargetGroup(ProjectTargetGroup $group)
    {
        $this->projectTargetGroup->removeElement($group);
    }

    /**
     * @return mixed
     */
    public function getProjectPriority()
    {
        return $this->projectPriority;
    }

    /**
     * @param mixed $projectPriority
     */
    public function setProjectPriority($projectPriority)
    {
        $this->projectPriority = $projectPriority;
    }

    public function addProjectPriority(ProjectPriority $group)
    {
        $this->projectPriority->add($group);
    }

    public function removeProjectPriority(ProjectPriority $group)
    {
        $this->projectPriority->removeElement($group);
    }

    /**
     * @return mixed
     */
    public function getSubjectAreas()
    {
        return $this->subjectAreas;
    }

    /**
     * @param mixed $subjectAreas
     */
    public function setSubjectAreas($subjectAreas)
    {
        $this->subjectAreas = $subjectAreas;
    }

    public function addSubjectAreas(ProjectSubjectArea $subjectArea)
    {
        $this->subjectAreas->add($subjectArea);
    }

    public function removeSubjectAreas(ProjectSubjectArea $subjectArea)
    {
        $this->subjectAreas->removeElement($subjectArea);
    }

    public function getName($locale) {
        if ($locale == "sr"){
            return $this->nameSr;
        }
        return $this->nameEn;
    }

    /**
     * @return mixed
     */
    public function getApplicationYear()
    {
        return $this->applicationYear;
    }

    /**
     * @param mixed $applicationYear
     */
    public function setApplicationYear($applicationYear)
    {
        $this->applicationYear = $applicationYear;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param string $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    }

    /**
     * @return string
     */
    public function getProjectGrant()
    {
        return $this->projectGrant;
    }

    /**
     * @param string $projectGrant
     */
    public function setProjectGrant($projectGrant)
    {
        $this->projectGrant = $projectGrant;
    }

    /**
     * @return mixed
     */
    public function getCofinancing()
    {
        return $this->cofinancing;
    }

    /**
     * @param mixed $cofinancing
     */
    public function setCofinancing($cofinancing)
    {
        $this->cofinancing = $cofinancing;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return mixed
     */
    public function getHorizontalPriorityType()
    {
        return $this->horizontalPriorityType;
    }

    /**
     * @param mixed $horizontalPriorityType
     */
    public function setHorizontalPriorityType($horizontalPriorityType)
    {
        $this->horizontalPriorityType = $horizontalPriorityType;
    }

    /**
     * @return mixed
     */
    public function getVerticalPriorityType()
    {
        return $this->verticalPriorityType;
    }

    /**
     * @param mixed $verticalPriorityType
     */
    public function setVerticalPriorityType($verticalPriorityType)
    {
        $this->verticalPriorityType = $verticalPriorityType;
    }

    /**
     * @return mixed
     */
    public function getProjectStatusType()
    {
        return $this->projectStatusType;
    }

    /**
     * @param mixed $projectStatusType
     */
    public function setProjectStatusType($projectStatusType)
    {
        $this->projectStatusType = $projectStatusType;
    }

    /**
     * @return mixed
     */
    public function getProjectScopeType()
    {
        return $this->projectScopeType;
    }

    /**
     * @param mixed $projectScopeType
     */
    public function setProjectScopeType($projectScopeType)
    {
        $this->projectScopeType = $projectScopeType;
    }

    /**
     * @return mixed
     */
    public function getContactPersonKa2()
    {
        return $this->contactPersonKa2;
    }

    /**
     * @param mixed $contactPersonKa2
     */
    public function setContactPersonKa2($contactPersonKa2)
    {
        $this->contactPersonKa2 = $contactPersonKa2;
    }

    /**
     * @return mixed
     */
    public function getRemarkOfficer()
    {
        return $this->remarkOfficer;
    }

    /**
     * @param mixed $remarkOfficer
     */
    public function setRemarkOfficer($remarkOfficer)
    {
        $this->remarkOfficer = $remarkOfficer;
    }

    /**
     * @return mixed
     */
    public function getRemarkGrade()
    {
        return $this->remarkGrade;
    }

    /**
     * @param mixed $remarkGrade
     */
    public function setRemarkGrade($remarkGrade)
    {
        $this->remarkGrade = $remarkGrade;
    }

    /**
     * @return mixed
     */
    public function getProjectGradeType()
    {
        return $this->projectGradeType;
    }

    /**
     * @param mixed $projectGradeType
     */
    public function setProjectGradeType($projectGradeType)
    {
        $this->projectGradeType = $projectGradeType;
    }

    /**
     * @return mixed
     */
    public function getProjectSummaryEnglish()
    {
        return $this->projectSummaryEnglish;
    }

    /**
     * @param mixed $projectSummaryEnglish
     */
    public function setProjectSummaryEnglish($projectSummaryEnglish)
    {
        $this->projectSummaryEnglish = $projectSummaryEnglish;
    }

    /**
     * @return string
     */
    public function getProjectSummarySerbian()
    {
        return $this->projectSummarySerbian;
    }

    /**
     * @param string $projectSummarySerbian
     */
    public function setProjectSummarySerbian($projectSummarySerbian)
    {
        $this->projectSummarySerbian = $projectSummarySerbian;
    }

    /**
     * @return mixed
     */
    public function getProjectSummaryNative()
    {
        return $this->projectSummaryNative;
    }

    /**
     * @param mixed $projectSummaryNative
     */
    public function setProjectSummaryNative($projectSummaryNative)
    {
        $this->projectSummaryNative = $projectSummaryNative;
    }

    /**
     * @return mixed
     */
    public function getProjectObjectivesEnglish()
    {
        return $this->projectObjectivesEnglish;
    }

    /**
     * @param mixed $projectObjectivesEnglish
     */
    public function setProjectObjectivesEnglish($projectObjectivesEnglish)
    {
        $this->projectObjectivesEnglish = $projectObjectivesEnglish;
    }

    /**
     * @return mixed
     */
    public function getProjectObjectivesSerbian()
    {
        return $this->projectObjectivesSerbian;
    }

    /**
     * @param mixed $projectObjectivesSerbian
     */
    public function setProjectObjectivesSerbian($projectObjectivesSerbian)
    {
        $this->projectObjectivesSerbian = $projectObjectivesSerbian;
    }

    /**
     * @return mixed
     */
    public function getProjectObjectivesNative()
    {
        return $this->projectObjectivesNative;
    }

    /**
     * @param mixed $projectObjectivesNative
     */
    public function setProjectObjectivesNative($projectObjectivesNative)
    {
        $this->projectObjectivesNative = $projectObjectivesNative;
    }

    /**
     * @return mixed
     */
    public function getIsCompleted()
    {
        return $this->isCompleted;
    }

    /**
     * @param mixed $isCompleted
     */
    public function setIsCompleted($isCompleted)
    {
        $this->isCompleted = $isCompleted;
    }

    /**
     * @return ProjectSubjectArea
     */
    public function getSubjectArea()
    {
        return $this->getSubjectAreas()->first();
    }

    /**
     * @return mixed
     */
    public function getDifficultiesParticipantsAreFacing()
    {
        return $this->difficultiesParticipantsAreFacing;
    }

    /**
     * @param mixed $difficultiesParticipantsAreFacing
     */
    public function setDifficultiesParticipantsAreFacing($difficultiesParticipantsAreFacing)
    {
        $this->difficultiesParticipantsAreFacing = $difficultiesParticipantsAreFacing;
    }

}

