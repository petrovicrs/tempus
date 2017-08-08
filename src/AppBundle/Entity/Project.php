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
     * @var string $name
     * @Assert\Type("string")
     * @ORM\Column(name="name_eng", type="string", length=255)
     */
    protected $nameEn;

    /**
     * @var string $name
     * @Assert\Type("string")
     * @ORM\Column(name="name_srb", type="string", length=255)
     */
    protected $nameSr;

    /**
     * @var string $nameOriginalLetter
     * @Assert\Type("string")
     * @ORM\Column(name="name_original_letter", type="string", length=255)
     */
    protected $nameOriginalLetter;

    /**
     * @var string $acronym
     * @Assert\Type("string")
     * @ORM\Column(name="acronym", type="string", length=255)
     */
    protected $acronym;

    /**
     * @var string $projectNumber
     * @Assert\Type("string")
     * @ORM\Column(name="project_number", type="string", length=255)
     */
    protected $projectNumber;

    /**
     * @var string $projectSummary
     * @Assert\Type("string")
     * @ORM\Column(name="project_summary", type="string", length=255)
     */
    protected $projectSummary;

    /**
     * @ORM\Column(name="end_datetime", type="date")
     */
    protected $endDatetime;

    /**
     * @ORM\Column(name="start_datetime", type="date")
     */
    protected $startDatetime;

    /**
     * @ORM\Column(name="extended_until", type="date")
     */
    protected $extendedUntil;

    /**
    * @var integer $durationMonths
    * @Assert\Type("numeric")
    * @Column(type="integer", name="duration_months", options={"unsigned":true})
    */
    protected $durationMonths;

    /**
     * @ORM\Column(name="audited", type="boolean")
     */
    protected $audited;

    /**
     * @ORM\Column(name="on_going", type="boolean")
     */
    protected $onGoing;

    /**
     * @ORM\Column(name="participant_fewer_options", type="boolean")
     */
    protected $participantFewerOptions;

    /**
     * @ORM\Column(name="consortium", type="boolean")
     */
    protected $consortium;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectProgramme"
     * )
     */
    protected $programmes;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectKeyAction"
     * )
     */
    protected $keyActions;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectAction"
     * )
     */
    protected $actions;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectType"
     * )
     */
    protected $types;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectCall"
     * )
     */
    protected $calls;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectRound"
     * )
     */
    protected $rounds;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectFtOfficer"
     * )
     */
    protected $ftOfficers;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="ProjectEaceaOfficer"
     * )
     */
    protected $eaceaOfficers;

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
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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

}

