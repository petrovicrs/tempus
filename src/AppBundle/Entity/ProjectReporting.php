<?php
/**
 * Created by PhpStorm.
 * User: nemtish
 * Date: 28.09.17
 * Time: 22:19
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectReportingRepository")
 * @ORM\Table(name="project_reporting")
 */
class ProjectReporting extends AbstractAuditable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $project;

    /**
     * @ORM\OneToMany(targetEntity="Reporting", mappedBy="projectReporting", cascade={"persist"})
     */
    protected $reporting;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $savetnik;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $kontroluIzvrsio;

    /**
     * @ORM\Column(name="datum_prijema_izvestaja", type="date", nullable=true)
     */
    protected $datumPrijemaIzvestaja;

    /**
     * @ORM\Column(name="period_od", type="date", nullable=true)
     */
    protected $periodOd;

    /**
     * @ORM\Column(name="period_do", type="date", nullable=true)
     */
    protected $periodDo;

    /**
     * @var string $predmetMonitoringa
     * @Assert\Type("string")
     * @ORM\Column(name="predmet_monitoringa", type="string", length=255, nullable=true)
     */
    protected $predmetMonitoringa;

    /**
     * @ORM\Column(name="poslednji_monitoring", type="date", nullable=true)
     */
    protected $poslednjiMonitoring;

    /**
     * @var string $uvazenePrporuke
     * @Assert\Type("string")
     * @ORM\Column(name="uvazene_preporuke", type="string", length=255, nullable=true)
     */
    protected $uvazenePrporuke;

    /**
     * @var string $dokumentacijaPotupna
     * @Assert\Type("string")
     * @ORM\Column(name="dokumentacija_potupna", type="string", length=255, nullable=true)
     */
    protected $dokumentacijaPotupna;

    /**
     * @var string $korisnikDostavioDodatnuDokumentaciju
     * @Assert\Type("string")
     * @ORM\Column(name="korisnik_dostavio_dodatnu_dokumentaciju", type="string", length=255, nullable=true)
     */
    protected $korisnikDostavioDodatnuDokumentaciju;

    /**
     * @var string $pitanje1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_1", type="string", length=255, nullable=true)
     */
    protected $pitanje1;

    /**
     * @var string $pitanje2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_2", type="string", length=255, nullable=true)
     */
    protected $pitanje2;

    /**
     * @var string $pitanje2pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_2_pp_1", type="text", nullable=true)
     */
    protected $pitanje2pp1;

    /**
     * @var string $pitanje3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_3", type="string", length=255, nullable=true)
     */
    protected $pitanje3;

    /**
     * @var string $pitanje3pp1
     * @Assert\Type("string")
     * @ORM\Column(name="$pitanje_3_pp_1", type="text", nullable=true)
     */
    protected $pitanje3pp1;

    /**
     * @var string $pitanje4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_4", type="string", length=255, nullable=true)
     */
    protected $pitanje4;

    /**
     * @var string $pitanje5
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_5", type="string", length=255, nullable=true)
     */
    protected $pitanje5;

    /**
     * @var string $pitanje6
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_6", type="string", length=255, nullable=true)
     */
    protected $pitanje6;

    /**
     * @var string $pitanje7
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7", type="string", length=255, nullable=true)
     */
    protected $pitanje7;

    /**
     * @var string $pitanje8
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8", type="string", length=255, nullable=true)
     */
    protected $pitanje8;

    /**
     * @var string $pitanje9
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_9", type="string", length=255, nullable=true)
     */
    protected $pitanje9;

    /**
     * @var string $pitanje11
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_11", type="string", length=255, nullable=true)
     */
    protected $pitanje11;

    /**
     * @var string $pitanje12
     * @Assert\Type("string")
     * @ORM\Column(name="$pitanje_12", type="text", nullable=true)
     */
    protected $pitanje12;

    /**
     * @var string $pitanje13
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_13", type="string", length=255, nullable=true)
     */
    protected $pitanje13;

    /**
     * @var string $pitanje14
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_14", type="string", length=255, nullable=true)
     */
    protected $pitanje14;

    /**
     * @var string $pitanje15pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp1;

    /**
     * @var string $pitanje15pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_2", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp2;

    /**
     * @var string $pitanje15pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_3", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp3;

    /**
     * @var string $pitanje15pp4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_4", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp4;

    /**
     * @var string $pitanje15pp5pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_5_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp5pp1;

    /**
     * @var string $pitanje15pp5pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_5_pp_2", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp5pp2;

    /**
     * @var string $pitanje15pp5pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_5_pp_3", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp5pp3;

    /**
     * @var string $pitanje15pp5pp4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_15_pp_5_pp_4", type="string", length=255, nullable=true)
     */
    protected $pitanje15pp5pp4;

    /**
     * @var string $pitanje16
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_16", type="string", length=255, nullable=true)
     */
    protected $pitanje16;

    /**
     * @var string $pitanje17pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp1;

    /**
     * @var string $pitanje17pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_2", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp2;

    /**
     * @var string $pitanje17pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_3", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp3;

    /**
     * @var string $pitanje17pp4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_4", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp4;

    /**
     * @var string $pitanje17pp5pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_5_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp5pp1;

    /**
     * @var string $pitanje17pp5pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_5_pp_2", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp5pp2;

    /**
     * @var string $pitanje17pp5pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_5_pp_3", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp5pp3;

    /**
     * @var string $pitanje17pp5pp4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_17_pp_5_pp_4", type="string", length=255, nullable=true)
     */
    protected $pitanje17pp5pp4;

    /**
     * @var string $pitanje18
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_18", type="string", length=255, nullable=true)
     */
    protected $pitanje18;

    /**
     * @var string $pitanje19
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_19", type="string", length=255, nullable=true)
     */
    protected $pitanje19;

    /**
     * @var string $pitanje20
     * @Assert\Type("string")
     * @ORM\Column(name="$pitanje_20", type="text", nullable=true)
     */
    protected $pitanje20;

    /**
     * @var string $pitanje21
     * @Assert\Type("string")
     * @ORM\Column(name="$pitanje_21", type="text", nullable=true)
     */
    protected $pitanje21;

    /**
     * @var string $pitanje22
     * @Assert\Type("string")
     * @ORM\Column(name="$pitanje22", type="text", nullable=true)
     */
    protected $pitanje22;

    /**
     * @var string $planiranihUcenja
     * @Assert\Type("string")
     * @ORM\Column(name="$planiranih_ucenja", type="string", length=5, nullable=true)
     */
    protected $planiranihUcenja;

    /**
     * @var string $planiranihObuka
     * @Assert\Type("string")
     * @ORM\Column(name="$planiranih_obuka", type="string", length=5, nullable=true)
     */
    protected $planiranihObuka;

    /**
     * @var string $planiranihPraksi
     * @Assert\Type("string")
     * @ORM\Column(name="$planiranih_praksi", type="string", length=5, nullable=true)
     */
    protected $planiranihPraksi;

    /**
     * @var string $planiranihPosmatranja
     * @Assert\Type("string")
     * @ORM\Column(name="$planiranih_posmatranja", type="string", length=5, nullable=true)
     */
    protected $planiranihPosmatranja;

    /**
     * @var string $zapocetihUcenja
     * @Assert\Type("string")
     * @ORM\Column(name="$zapocetih_ucenja", type="string", length=5, nullable=true)
     */
    protected $zapocetihUcenja;

    /**
     * @var string $zapocetihObuka
     * @Assert\Type("string")
     * @ORM\Column(name="$zapocetih_obuka", type="string", length=5, nullable=true)
     */
    protected $zapocetihObuka;

    /**
     * @var string $zapocetihPraksi
     * @Assert\Type("string")
     * @ORM\Column(name="$zapocetih_praksi", type="string", length=5, nullable=true)
     */
    protected $zapocetihPraksi;

    /**
     * @var string $zapocetihPosmatranja
     * @Assert\Type("string")
     * @ORM\Column(name="$zapocetih_posmatranja", type="string", length=5, nullable=true)
     */
    protected $zapocetihPosmatranja;

    /**
     * @var string $sprovedenihUcenja
     * @Assert\Type("string")
     * @ORM\Column(name="$sprovedenih_ucenja", type="string", length=5, nullable=true)
     */
    protected $sprovedenihUcenja;

    /**
     * @var string $sprovedenihObuka
     * @Assert\Type("string")
     * @ORM\Column(name="$sprovedenih_obuka", type="string", length=5, nullable=true)
     */
    protected $sprovedenihObuka;

    /**
     * @var string $sprovedenihPraksi
     * @Assert\Type("string")
     * @ORM\Column(name="$sprovedenih_praksi", type="string", length=5, nullable=true)
     */
    protected $sprovedenihPraksi;

    /**
     * @var string $sprovedenihPosmatranja
     * @Assert\Type("string")
     * @ORM\Column(name="$sprovedenih_posmatranja", type="string", length=5, nullable=true)
     */
    protected $sprovedenihPosmatranja;

    /**
     * @var string $potpisanihUcenja
     * @Assert\Type("string")
     * @ORM\Column(name="$potpisanih_ucenja", type="string", length=5, nullable=true)
     */
    protected $potpisanihUcenja;

    /**
     * @var string $potpisanihObuka
     * @Assert\Type("string")
     * @ORM\Column(name="$potpisanih_obuka", type="string", length=5, nullable=true)
     */
    protected $potpisanihObuka;

    /**
     * @var string $potpisanihPraksi
     * @Assert\Type("string")
     * @ORM\Column(name="$potpisanih_praksi", type="string", length=5, nullable=true)
     */
    protected $potpisanihPraksi;

    /**
     * @var string $potpisanihPosmatranja
     * @Assert\Type("string")
     * @ORM\Column(name="$potpisanih_posmatranja", type="string", length=5, nullable=true)
     */
    protected $potpisanihPosmatranja;



    public function __construct()
    {
        parent::__construct();
        $this->reporting = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getReporting()
    {
        return $this->reporting;
    }

    /**
     * @return mixed
     */
    public function getSavetnik()
    {
        return $this->savetnik;
    }

    /**
     * @param mixed $savetnik
     */
    public function setSavetnik($savetnik)
    {
        $this->savetnik = $savetnik;
    }

    /**
     * @return mixed
     */
    public function getKontroluIzvrsio()
    {
        return $this->kontroluIzvrsio;
    }

    /**
     * @param mixed $kontroluIzvrsio
     */
    public function setKontroluIzvrsio($kontroluIzvrsio)
    {
        $this->kontroluIzvrsio = $kontroluIzvrsio;
    }

    /**
     * @return mixed
     */
    public function getDatumPrijemaIzvestaja()
    {
        return $this->datumPrijemaIzvestaja;
    }

    /**
     * @param mixed $datumPrijemaIzvestaja
     */
    public function setDatumPrijemaIzvestaja($datumPrijemaIzvestaja)
    {
        $this->datumPrijemaIzvestaja = $datumPrijemaIzvestaja;
    }

    /**
     * @return mixed
     */
    public function getPeriodOd()
    {
        return $this->periodOd;
    }

    /**
     * @param mixed $periodOd
     */
    public function setPeriodOd($periodOd)
    {
        $this->periodOd = $periodOd;
    }

    /**
     * @return mixed
     */
    public function getPeriodDo()
    {
        return $this->periodDo;
    }

    /**
     * @param mixed $periodDo
     */
    public function setPeriodDo($periodDo)
    {
        $this->periodDo = $periodDo;
    }

    /**
     * @return mixed
     */
    public function getPredmetMonitoringa()
    {
        return $this->predmetMonitoringa;
    }

    /**
     * @param mixed $predmetMonitoringa
     */
    public function setPredmetMonitoringa($predmetMonitoringa)
    {
        $this->predmetMonitoringa = $predmetMonitoringa;
    }

    /**
     * @return mixed
     */
    public function getPoslednjiMonitoring()
    {
        return $this->poslednjiMonitoring;
    }

    /**
     * @param mixed $poslednjiMonitoring
     */
    public function setPoslednjiMonitoring($poslednjiMonitoring)
    {
        $this->poslednjiMonitoring = $poslednjiMonitoring;
    }

    /**
     * @return mixed
     */
    public function getUvazenePrporuke()
    {
        return $this->uvazenePrporuke;
    }

    /**
     * @param mixed $uvazenePrporuke
     */
    public function setUvazenePrporuke($uvazenePrporuke)
    {
        $this->uvazenePrporuke = $uvazenePrporuke;
    }

    /**
     * @return mixed
     */
    public function getDokumentacijaPotupna()
    {
        return $this->dokumentacijaPotupna;
    }

    /**
     * @param string $dokumentacijaPotupna
     */
    public function setDokumentacijaPotupna($dokumentacijaPotupna)
    {
        $this->dokumentacijaPotupna = $dokumentacijaPotupna;
    }

    /**
     * @return mixed
     */
    public function getKorisnikDostavioDodatnuDokumentaciju()
    {
        return $this->korisnikDostavioDodatnuDokumentaciju;
    }

    /**
     * @param mixed $korisnikDostavioDodatnuDokumentaciju
     */
    public function setKorisnikDostavioDodatnuDokumentaciju($korisnikDostavioDodatnuDokumentaciju)
    {
        $this->korisnikDostavioDodatnuDokumentaciju = $korisnikDostavioDodatnuDokumentaciju;
    }

    /**
     * @return mixed
     */
    public function getPitanje1()
    {
        return $this->pitanje1;
    }

    /**
     * @param mixed $pitanje1
     */
    public function setPitanje1($pitanje1)
    {
        $this->pitanje1 = $pitanje1;
    }

    /**
     * @return mixed
     */
    public function getPitanje2()
    {
        return $this->pitanje2;
    }

    /**
     * @param mixed $pitanje2
     */
    public function setPitanje2($pitanje2)
    {
        $this->pitanje2 = $pitanje2;
    }

    /**
     * @return mixed
     */
    public function getPitanje2pp1()
    {
        return $this->pitanje2pp1;
    }

    /**
     * @param mixed $pitanje2pp1
     */
    public function setPitanje2pp1($pitanje2pp1)
    {
        $this->pitanje2pp1 = $pitanje2pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje3()
    {
        return $this->pitanje3;
    }

    /**
     * @param mixed $pitanje3
     */
    public function setPitanje3($pitanje3)
    {
        $this->pitanje3 = $pitanje3;
    }

    /**
     * @return mixed
     */
    public function getPitanje3pp1()
    {
        return $this->pitanje3pp1;
    }

    /**
     * @param mixed $pitanje3pp1
     */
    public function setPitanje3pp1($pitanje3pp1)
    {
        $this->pitanje3pp1 = $pitanje3pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje4()
    {
        return $this->pitanje4;
    }

    /**
     * @param mixed $pitanje4
     */
    public function setPitanje4($pitanje4)
    {
        $this->pitanje4 = $pitanje4;
    }

    /**
     * @return mixed
     */
    public function getPitanje5()
    {
        return $this->pitanje5;
    }

    /**
     * @param mixed $pitanje5
     */
    public function setPitanje5($pitanje5)
    {
        $this->pitanje5 = $pitanje5;
    }

    /**
     * @return mixed
     */
    public function getPitanje6()
    {
        return $this->pitanje6;
    }

    /**
     * @param mixed $pitanje6
     */
    public function setPitanje6($pitanje6)
    {
        $this->pitanje6 = $pitanje6;
    }

    /**
     * @return mixed
     */
    public function getPitanje7()
    {
        return $this->pitanje7;
    }

    /**
     * @param mixed $pitanje7
     */
    public function setPitanje7($pitanje7)
    {
        $this->pitanje7 = $pitanje7;
    }

    /**
     * @return mixed
     */
    public function getPitanje8()
    {
        return $this->pitanje8;
    }

    /**
     * @param mixed $pitanje8
     */
    public function setPitanje8($pitanje8)
    {
        $this->pitanje8 = $pitanje8;
    }

    /**
     * @return mixed
     */
    public function getPitanje9()
    {
        return $this->pitanje9;
    }

    /**
     * @param mixed $pitanje9
     */
    public function setPitanje9($pitanje9)
    {
        $this->pitanje9 = $pitanje9;
    }

    /**
     * @return mixed
     */
    public function getPlaniranihUcenja()
    {
        return $this->planiranihUcenja;
    }

    /**
     * @param mixed $planiranihUcenja
     */
    public function setPlaniranihUcenja($planiranihUcenja)
    {
        $this->planiranihUcenja = $planiranihUcenja;
    }

    /**
     * @return mixed
     */
    public function getPlaniranihObuka()
    {
        return $this->planiranihObuka;
    }

    /**
     * @param mixed $planiranihObuka
     */
    public function setPlaniranihObuka($planiranihObuka)
    {
        $this->planiranihObuka = $planiranihObuka;
    }

    /**
     * @return mixed
     */
    public function getPlaniranihPraksi()
    {
        return $this->planiranihPraksi;
    }

    /**
     * @param mixed $planiranihPraksi
     */
    public function setPlaniranihPraksi($planiranihPraksi)
    {
        $this->planiranihPraksi = $planiranihPraksi;
    }

    /**
     * @return mixed
     */
    public function getPlaniranihPosmatranja()
    {
        return $this->planiranihPosmatranja;
    }

    /**
     * @param mixed planiranihPosmatranja
     */
    public function setPlaniranihPosmatranja($planiranihPosmatranja)
    {
        $this->planiranihPosmatranja = $planiranihPosmatranja;
    }

    /**
     * @return mixed
     */
    public function getZapocetihUcenja()
    {
        return $this->zapocetihUcenja;
    }

    /**
     * @param mixed $zapocetihUcenja
     */
    public function setZapocetihUcenja($zapocetihUcenja)
    {
        $this->zapocetihUcenja = $zapocetihUcenja;
    }

    /**
     * @return mixed
     */
    public function getZapocetihObuka()
    {
        return $this->zapocetihObuka;
    }

    /**
     * @param mixed $zapocetihObuka
     */
    public function setZapocetihObuka($zapocetihObuka)
    {
        $this->zapocetihObuka = $zapocetihObuka;
    }

    /**
     * @return mixed
     */
    public function getZapocetihPraksi()
    {
        return $this->zapocetihPraksi;
    }

    /**
     * @param mixed $zapocetihPraksi
     */
    public function setZapocetihPraksi($zapocetihPraksi)
    {
        $this->zapocetihPraksi = $zapocetihPraksi;
    }

    /**
     * @return mixed
     */
    public function getZapocetihPosmatranja()
    {
        return $this->zapocetihPosmatranja;
    }

    /**
     * @param mixed $zapocetihPosmatranja
     */
    public function setZapocetihPosmatranja($zapocetihPosmatranja)
    {
        $this->zapocetihPosmatranja = $zapocetihPosmatranja;
    }

    /**
     * @return mixed
     */
    public function getSprovedenihUcenja()
    {
        return $this->sprovedenihUcenja;
    }

    /**
     * @param mixed $sprovedenihUcenja
     */
    public function setSprovedenihUcenja($sprovedenihUcenja)
    {
        $this->sprovedenihUcenja = $sprovedenihUcenja;
    }

    /**
     * @return mixed
     */
    public function getSprovedenihObuka()
    {
        return $this->sprovedenihObuka;
    }

    /**
     * @param mixed $sprovedenihObuka
     */
    public function setSprovedenihObuka($sprovedenihObuka)
    {
        $this->sprovedenihObuka = $sprovedenihObuka;
    }

    /**
     * @return mixed
     */
    public function getSprovedenihPraksi()
    {
        return $this->sprovedenihPraksi;
    }

    /**
     * @param mixed $sprovedenihPraksi
     */
    public function setSprovedenihPraksi($sprovedenihPraksi)
    {
        $this->sprovedenihPraksi = $sprovedenihPraksi;
    }

    /**
     * @return mixed
     */
    public function getSprovedenihPosmatranja()
    {
        return $this->sprovedenihPosmatranja;
    }

    /**
     * @param mixed $sprovedenihPosmatranja
     */
    public function setSprovedenihPosmatranja($sprovedenihPosmatranja)
    {
        $this->sprovedenihPosmatranja = $sprovedenihPosmatranja;
    }

    /**
     * @return mixed
     */
    public function getPotpisanihUcenja()
    {
        return $this->potpisanihUcenja;
    }

    /**
     * @param mixed $potpisanihUcenja
     */
    public function setPotpisanihUcenja($potpisanihUcenja)
    {
        $this->potpisanihUcenja = $potpisanihUcenja;
    }

    /**
     * @return mixed
     */
    public function getPotpisanihObuka()
    {
        return $this->potpisanihObuka;
    }

    /**
     * @param mixed $potpisanihObuka
     */
    public function setPotpisanihObuka($potpisanihObuka)
    {
        $this->potpisanihObuka = $potpisanihObuka;
    }

    /**
     * @return mixed
     */
    public function getPotpisanihPraksi()
    {
        return $this->potpisanihPraksi;
    }

    /**
     * @param mixed $potpisanihPraksi
     */
    public function setPotpisanihPraksi($potpisanihPraksi)
    {
        $this->potpisanihPraksi = $potpisanihPraksi;
    }

    /**
     * @return mixed
     */
    public function getPotpisanihPosmatranja()
    {
        return $this->potpisanihPosmatranja;
    }

    /**
     * @param mixed $potpisanihPosmatranja
     */
    public function setPotpisanihPosmatranja($potpisanihPosmatranja)
    {
        $this->potpisanihPosmatranja = $potpisanihPosmatranja;
    }

    /**
     * @return mixed
     */
    public function getPitanje11()
    {
        return $this->pitanje11;
    }

    /**
     * @param mixed $pitanje11
     */
    public function setPitanje11($pitanje11)
    {
        $this->pitanje11 = $pitanje11;
    }

    /**
     * @return mixed
     */
    public function getPitanje12()
    {
        return $this->pitanje12;
    }

    /**
     * @param mixed $pitanje12
     */
    public function setPitanje12($pitanje12)
    {
        $this->pitanje12 = $pitanje12;
    }

    /**
     * @return mixed
     */
    public function getPitanje13()
    {
        return $this->pitanje13;
    }

    /**
     * @param mixed $pitanje13
     */
    public function setPitanje13($pitanje13)
    {
        $this->pitanje13 = $pitanje13;
    }

    /**
     * @return mixed
     */
    public function getPitanje14()
    {
        return $this->pitanje14;
    }

    /**
     * @param mixed $pitanje14
     */
    public function setPitanje14($pitanje14)
    {
        $this->pitanje14 = $pitanje14;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp1()
    {
        return $this->pitanje15pp1;
    }

    /**
     * @param mixed $pitanje15pp1
     */
    public function setPitanje15pp1($pitanje15pp1)
    {
        $this->pitanje15pp1 = $pitanje15pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp2()
    {
        return $this->pitanje15pp2;
    }

    /**
     * @param mixed $pitanje15pp2
     */
    public function setPitanje15pp2($pitanje15pp2)
    {
        $this->pitanje15pp2 = $pitanje15pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp3()
    {
        return $this->pitanje15pp3;
    }

    /**
     * @param mixed $pitanje15pp3
     */
    public function setPitanje15pp3($pitanje15pp3)
    {
        $this->pitanje15pp3 = $pitanje15pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp4(){
        return $this->pitanje15pp4;
    }

    /**
     * @param mixed $pitanje15pp4
     */
    public function setPitanje15pp4($pitanje15pp4)
    {
        $this->pitanje15pp4 = $pitanje15pp4;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp5pp1()
    {
        return $this->pitanje15pp5pp1;
    }

    /**
     * @param mixed $pitanje15pp5pp1
     */
    public function setPitanje15pp5pp1($pitanje15pp5pp1)
    {
        $this->pitanje15pp5pp1 = $pitanje15pp5pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp5pp2()
    {
        return $this->pitanje15pp5pp2;
    }

    /**
     * @param mixed $pitanje15pp5pp2
     */
    public function setPitanje15pp5pp2($pitanje15pp5pp2)
    {
        $this->pitanje15pp5pp2 = $pitanje15pp5pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp5pp3()
    {
        return $this->pitanje15pp5pp3;
    }

    /**
     * @param mixed $pitanje15pp5pp3
     */
    public function setPitanje15pp5pp3($pitanje15pp5pp3)
    {
        $this->pitanje15pp5pp3 = $pitanje15pp5pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje15pp5pp4()
    {
        return $this->pitanje15pp5pp4;
    }

    /**
     * @param mixed $pitanje15pp5pp4
     */
    public function setPitanje15pp5pp4($pitanje15pp5pp4)
    {
        $this->pitanje15pp5pp4 = $pitanje15pp5pp4;
    }

    /**
     * @return mixed
     */
    public function getPitanje16()
    {
        return $this->pitanje16;
    }

    /**
     * @param mixed $pitanje16
     */
    public function setPitanje16($pitanje16)
    {
        $this->pitanje16 = $pitanje16;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp1()
    {
        return $this->pitanje17pp1;
    }

    /**
     * @param mixed $pitanje17pp1
     */
    public function setPitanje17pp1($pitanje17pp1)
    {
        $this->pitanje17pp1 = $pitanje17pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp2()
    {
        return $this->pitanje17pp2;
    }

    /**
     * @param mixed $pitanje17pp2
     */
    public function setPitanje17pp2($pitanje17pp2)
    {
        $this->pitanje17pp2 = $pitanje17pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp3()
    {
        return $this->pitanje17pp3;
    }

    /**
     * @param mixed $pitanje17pp3
     */
    public function setPitanje17pp3($pitanje17pp3)
    {
        $this->pitanje17pp3 = $pitanje17pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp4(){
        return $this->pitanje17pp4;
    }

    /**
     * @param mixed $pitanje17pp4
     */
    public function setPitanje17pp4($pitanje17pp4)
    {
        $this->pitanje17pp4 = $pitanje17pp4;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp5pp1()
    {
        return $this->pitanje17pp5pp1;
    }

    /**
     * @param mixed $pitanje17pp5pp1
     */
    public function setPitanje17pp5pp1($pitanje17pp5pp1)
    {
        $this->pitanje17pp5pp1 = $pitanje17pp5pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp5pp2()
    {
        return $this->pitanje17pp5pp2;
    }

    /**
     * @param mixed $pitanje17pp5pp2
     */
    public function setPitanje17pp5pp2($pitanje17pp5pp2)
    {
        $this->pitanje17pp5pp2 = $pitanje17pp5pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp5pp3()
    {
        return $this->pitanje17pp5pp3;
    }

    /**
     * @param mixed $pitanje17pp5pp3
     */
    public function setPitanje17pp5pp3($pitanje17pp5pp3)
    {
        $this->pitanje17pp5pp3 = $pitanje17pp5pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje17pp5pp4()
    {
        return $this->pitanje17pp5pp4;
    }

    /**
     * @param mixed $pitanje17pp5pp4
     */
    public function setPitanje17pp5pp4($pitanje17pp5pp4)
    {
        $this->pitanje17pp5pp4 = $pitanje17pp5pp4;
    }

    /**
     * @return mixed
     */
    public function getPitanje18()
    {
        return $this->pitanje18;
    }

    /**
     * @param mixed $pitanje18
     */
    public function setPitanje18($pitanje18)
    {
        $this->pitanje18 = $pitanje18;
    }

    /**
     * @return mixed
     */
    public function getPitanje19()
    {
        return $this->pitanje19;
    }

    /**
     * @param mixed $pitanje19
     */
    public function setPitanje19($pitanje19)
    {
        $this->pitanje19 = $pitanje19;
    }

    /**
     * @return mixed
     */
    public function getPitanje20()
    {
        return $this->pitanje20;
    }

    /**
     * @param mixed $pitanje20
     */
    public function setPitanje20($pitanje20)
    {
        $this->pitanje20 = $pitanje20;
    }

    /**
     * @return mixed
     */
    public function getPitanje21()
    {
        return $this->pitanje21;
    }

    /**
     * @param mixed $pitanje21
     */
    public function setPitanje21($pitanje21)
    {
        $this->pitanje21 = $pitanje21;
    }

    /**
     * @return mixed
     */
    public function getPitanje22()
    {
        return $this->pitanje22;
    }

    /**
     * @param mixed $pitanje22
     */
    public function setPitanje22($pitanje22)
    {
        $this->pitanje22 = $pitanje22;
    }


}