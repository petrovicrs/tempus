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
     * @ORM\OneToMany(targetEntity="ProjectNote", mappedBy="institution", cascade={"persist"})
     */
    protected $notes;

    /**
     * @ORM\OneToMany(targetEntity="ProjectApplicantOrganisation", mappedBy="institution", cascade={"persist"})
     */
    protected $applicantOrganisations;

    /**
     * @ORM\OneToMany(targetEntity="ProjectPartnerOrganisation", mappedBy="institution", cascade={"persist"})
     */
    protected $partnerOrganisations;

    /**
     * @ORM\OneToMany(targetEntity="ProjectLimitation", mappedBy="institution", cascade={"persist"})
     */
    protected $limitations;

    /**
     * @ORM\OneToMany(targetEntity="ProjectContactPerson", mappedBy="institution", cascade={"persist"})
     */
    protected $contactPersons;

    /**
     * @ORM\OneToMany(targetEntity="ProjectTopic", mappedBy="institution", cascade={"persist"})
     */
    protected $topics;

    /**
     * @ORM\OneToMany(targetEntity="ProjectSubjectArea", mappedBy="institution", cascade={"persist"})
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
    public function setNotes(ArrayCollection $notes)
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
    public function getLimitations()
    {
        return $this->limitations;
    }

    /**
     * @param mixed $limitations
     */
    public function setLimitations(ArrayCollection $limitation)
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
    public function setSubjectAreas(ArrayCollection $subjectAreas)
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

}

