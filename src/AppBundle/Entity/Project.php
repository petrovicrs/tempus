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
    protected $nameEng;

    /**
     * @var string $name
     * @Assert\Type("string")
     * @ORM\Column(name="name_srb", type="string", length=255)
     */
    protected $nameSrb;

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
     * @ORM\Column(name="end_datetime", type="datetime")
     */
    protected $endDatetime;

    /**
     * @ORM\Column(name="start_datetime", type="datetime")
     */
    protected $startDatetime;

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
     * @ORM\OneToMany(targetEntity="projectProgramme", mappedBy="institution", cascade={"persist"})
     */
    protected $programmes;

    /**
     * @ORM\OneToMany(targetEntity="projectKeyAction", mappedBy="institution", cascade={"persist"})
     */
    protected $keyActions;

    /**
     * @ORM\OneToMany(targetEntity="projectAction", mappedBy="institution", cascade={"persist"})
     */
    protected $actions;

    /**
     * @ORM\OneToMany(targetEntity="projectCall", mappedBy="institution", cascade={"persist"})
     */
    protected $calls;

    /**
     * @ORM\OneToMany(targetEntity="projectRound", mappedBy="institution", cascade={"persist"})
     */
    protected $rounds;

    /**
     * @ORM\OneToMany(targetEntity="projectNotes", mappedBy="institution", cascade={"persist"})
     */
    protected $notes;

    /**
     * @ORM\OneToMany(targetEntity="projectApplicantOrganisation", mappedBy="institution", cascade={"persist"})
     */
    protected $applicantOrganisations;

    /**
     * @ORM\OneToMany(targetEntity="projectPartnerOrganisation", mappedBy="institution", cascade={"persist"})
     */
    protected $partnerOrganisations;

    /**
     * @ORM\OneToMany(targetEntity="projectTypeOfLimitation", mappedBy="institution", cascade={"persist"})
     */
    protected $typeOfLimitations;

    /**
     * @ORM\OneToMany(targetEntity="projectContactPerson", mappedBy="institution", cascade={"persist"})
     */
    protected $contactPersons;

    /**
     * @ORM\OneToMany(targetEntity="projectTopics", mappedBy="institution", cascade={"persist"})
     */
    protected $topics;

    /**
     * @ORM\OneToMany(targetEntity="projectSubjectAreas", mappedBy="institution", cascade={"persist"})
     */
    protected $subjectAreas;

    /**
     * @ORM\OneToMany(targetEntity="projectFtOfficer", mappedBy="institution", cascade={"persist"})
     */
    protected $ftOfficers;

    /**
     * @ORM\OneToMany(targetEntity="projectEaceaOfficer", mappedBy="institution", cascade={"persist"})
     */
    protected $eaceaOfficers;

    public function __construct()
    {
        parent::__construct();
        $this->eaceaOfficers = new ArrayCollection();
        $this->ftOfficers = new ArrayCollection();
        $this->subjectAreas = new ArrayCollection();
        $this->topics = new ArrayCollection();
        $this->contactPersons = new ArrayCollection();
        $this->typeOfLimitations = new ArrayCollection();
        $this->partnerOrganisations = new ArrayCollection();
        $this->applicantOrganisations = new ArrayCollection();
        $this->notes = new ArrayCollection();
        $this->rounds = new ArrayCollection();
        $this->calls = new ArrayCollection();
        $this->actions = new ArrayCollection();
        $this->keyActions = new ArrayCollection();
        $this->programmes = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNameEng(): string
    {
        return $this->nameEng;
    }

    /**
     * @param string $nameEng
     */
    public function setNameEng(string $nameEng)
    {
        $this->nameEng = $nameEng;
    }

    /**
     * @return string
     */
    public function getNameSrb(): string
    {
        return $this->nameSrb;
    }

    /**
     * @param string $nameSrb
     */
    public function setNameSrb(string $nameSrb)
    {
        $this->nameSrb = $nameSrb;
    }

    /**
     * @return string
     */
    public function getNameOriginalLetter(): string
    {
        return $this->nameOriginalLetter;
    }

    /**
     * @param string $nameOriginalLetter
     */
    public function setNameOriginalLetter(string $nameOriginalLetter)
    {
        $this->nameOriginalLetter = $nameOriginalLetter;
    }

    /**
     * @return string
     */
    public function getAcronym(): string
    {
        return $this->acronym;
    }

    /**
     * @param string $acronym
     */
    public function setAcronym(string $acronym)
    {
        $this->acronym = $acronym;
    }

    /**
     * @return string
     */
    public function getProjectNumber(): string
    {
        return $this->projectNumber;
    }

    /**
     * @param string $projectNumber
     */
    public function setProjectNumber(string $projectNumber)
    {
        $this->projectNumber = $projectNumber;
    }

    /**
     * @return string
     */
    public function getProjectSummary(): string
    {
        return $this->projectSummary;
    }

    /**
     * @param string $projectSummary
     */
    public function setProjectSummary(string $projectSummary)
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
     * @return int
     */
    public function getDurationMonths(): int
    {
        return $this->durationMonths;
    }

    /**
     * @param int $durationMonths
     */
    public function setDurationMonths(int $durationMonths)
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
    public function getProgrammes()
    {
        return $this->programmes;
    }

    /**
     * @param mixed $programmes
     */
    public function setProgrammes(ArrayCollection $programmes)
    {
        $this->programmes = $programmes;
    }

    public function addProgrammes(ProjectProgramme $programme)
    {
        $this->programmes->add($programme);
    }

    public function removeProgrammes(ProjectProgramme $programme)
    {
        $this->programmes->removeElement($programme);
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
    public function setKeyActions(ArrayCollection $keyActions)
    {
        $this->keyActions = $keyActions;
    }

    public function addKeyAction(ProjectKeyAction $keyAction)
    {
        $this->keyActions->add($keyAction);
    }

    public function removeKeyAction(ProjectKeyAction $keyAction)
    {
        $this->keyActions->removeElement($keyAction);
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
    public function setActions(ArrayCollection $actions)
    {
        $this->actions = $actions;
    }

    public function addActions(ProjectAction $call)
    {
        $this->actions->add($call);
    }

    public function removeActions(ProjectAction $call)
    {
        $this->actions->removeElement($call);
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
    public function setCalls(ArrayCollection $calls)
    {
        $this->calls = $calls;
    }

    public function addCalls(ProjectCall $call)
    {
        $this->calls->add($call);
    }

    public function removeCalls(ProjectCall $call)
    {
        $this->calls->removeElement($call);
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
    public function setRounds(ArrayCollection $rounds)
    {
        $this->rounds = $rounds;
    }

    public function addRounds(ProjectRound $round)
    {
        $this->rounds->add($round);
    }

    public function removeRounds(ProjectRound $round)
    {
        $this->rounds->removeElement($round);
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
    public function setNotes(ArrayCollection $notes)
    {
        $this->notes = $notes;
    }

    public function addNotes(PicNumber $note)
    {
        $this->notes->add($note);
    }

    public function removeNotes(PicNumber $note)
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
     * @param mixed $applicantOrganisations
     */
    public function setApplicantOrganisations(ArrayCollection $applicantOrganisations)
    {
        $this->applicantOrganisations = $applicantOrganisations;
    }

    public function addApplicantOrganisations(PicNumber $applicantOrganisation)
    {
        $this->applicantOrganisations->add($applicantOrganisation);
    }

    public function removeApplicantOrganisations(PicNumber $applicantOrganisation)
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
    public function setPartnerOrganisations(ArrayCollection $partnerOrganisations)
    {
        $this->partnerOrganisations = $partnerOrganisations;
    }

    public function addPartnerOrganisations(PicNumber $partnerOrganisation)
    {
        $this->partnerOrganisations->add($partnerOrganisation);
    }

    public function removePartnerOrganisations(PicNumber $partnerOrganisation)
    {
        $this->partnerOrganisations->removeElement($partnerOrganisation);
    }

    /**
     * @return mixed
     */
    public function getTypeOfLimitations()
    {
        return $this->typeOfLimitations;
    }

    /**
     * @param mixed $typeOfLimitations
     */
    public function setTypeOfLimitations(ArrayCollection $typeOfLimitations)
    {
        $this->typeOfLimitations = $typeOfLimitations;
    }

    public function addTypeOfLimitations(PicNumber $typeOfLimitation)
    {
        $this->typeOfLimitations->add($typeOfLimitation);
    }

    public function removeTypeOfLimitations(PicNumber $typeOfLimitation)
    {
        $this->typeOfLimitations->removeElement($typeOfLimitation);
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
    public function setContactPersons(ArrayCollection $contactPersons)
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
    public function setTopics(ArrayCollection $topics)
    {
        $this->topics = $topics;
    }

    public function addTopics(PicNumber $topic)
    {
        $this->topics->add($topic);
    }

    public function removeTopics(PicNumber $topic)
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
    public function setSubjectAreas(ArrayCollection $subjectAreas)
    {
        $this->subjectAreas = $subjectAreas;
    }

    public function addSubjectAreas(PicNumber $subjectArea)
    {
        $this->subjectAreas->add($subjectArea);
    }

    public function removeSubjectAreas(PicNumber $subjectArea)
    {
        $this->subjectAreas->removeElement($subjectArea);
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
    public function setFtOfficers(ArrayCollection $ftOfficers)
    {
        $this->ftOfficers = $ftOfficers;
    }

    public function addFtOfficers(PicNumber $ftOfficer)
    {
        $this->ftOfficers->add($ftOfficer);
    }

    public function removeFtOfficers(PicNumber $ftOfficer)
    {
        $this->ftOfficers->removeElement($ftOfficer);
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
    public function setEaceaOfficers(ArrayCollection $eaceaOfficers)
    {
        $this->eaceaOfficers = $eaceaOfficers;
    }

    public function addEaceaOfficers(PicNumber $eaceaOfficer)
    {
        $this->eaceaOfficers->add($eaceaOfficer);
    }

    public function removeEaceaOfficers(PicNumber $eaceaOfficer)
    {
        $this->eaceaOfficers->removeElement($eaceaOfficer);
    }
}

