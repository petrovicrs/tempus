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
     * @ORM\ManyToOne(targetEntity="ReportingType")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $reportingType;

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
     * @var string $pitanje10
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_10", type="string", length=255, nullable=true)
     */
    protected $pitanje10;

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

    /**
     * @var string $pitanje_105_1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_1", type="string", length=255, nullable=true)
     */
    protected $pitanje_105_1;

    /**
     * @var string $pitanje_105_1_1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_1_1", type="text", nullable=true)
     */
    protected $pitanje_105_1_1;

    /**
     * @var string $pitanje_105_2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_2", type="string", length=255, nullable=true)
     */
    protected $pitanje_105_2;

    /**
     * @var string $pitanje_105_2_1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_2_1", type="text", nullable=true)
     */
    protected $pitanje_105_2_1;

    /**
     * @var string $pitanje_105_4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_4", type="string", length=255, nullable=true)
     */
    protected $pitanje_105_4;

    /**
     * @var string $pitanje_105_13
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_13", type="string", length=255, nullable=true)
     */
    protected $pitanje_105_13;

    /**
     * @var string $pitanje_105_14
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_105_14", type="string", length=255, nullable=true)
     */
    protected $pitanje_105_14;

    /**
     * @ORM\Column(name="ulazak_izvestaja", type="date", nullable=true)
     */
    protected $ulazakIzvestaja;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $proveruIzvrsio;

    /**
     * @var string $potpunaFinansijskaDokumentacija
     * @Assert\Type("string")
     * @ORM\Column(name="potpuna_finansijska_dokumentacija", type="string", length=255, nullable=true)
     */
    protected $potpunaFinansijskaDokumentacija;

    /**
     * @ORM\Column(name="datum_posete", type="date", nullable=true)
     */
    protected $datumPosete;

    /**
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $dokumentPregledao;

    /**
     * @var string $potpunaDodatnaDokumentacija
     * @Assert\Type("string")
     * @ORM\Column(name="potpuna_dodatna_dokumentacija", type="string", length=255, nullable=true)
     */
    protected $potpunaDodatnaDokumentacija;

    /**
     * @var string $razlogNepotpuneDokumentacije
     * @Assert\Type("string")
     * @ORM\Column(name="razlog_nepotpune_dokumentacije", type="text", nullable=true)
     */
    protected $razlogNepotpuneDokumentacije;

    /**
     * @ORM\Column(name="datum_trazenja_dodatne_dokumentacije", type="date", nullable=true)
     */
    protected $datumTrazenjaDodatneDokumentacije;

    /**
     * @ORM\Column(name="datum_dostavljanja_dodatne_dokumentacije", type="date", nullable=true)
     */
    protected $datumDostavljanjaDodatneDokumentacije;

    /**
     * @var string $apsorbovatiAlociranBudzet
     * @Assert\Type("string")
     * @ORM\Column(name="apsorbovati_alociran_budzet", type="string", length=255, nullable=true)
     */
    protected $apsorbovatiAlociranBudzet;

    /**
     * @ORM\Column(name="datum_Zavrsetka_obrade", type="date", nullable=true)
     */
    protected $datumZavrsetkaObrade;

    /**
     * @var string $pitanje1pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_1_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje1pp1;

    /**
     * @var string $pitanje3pp1pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_3_pp_1_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje3pp1pp1;

    /**
     * @var string $pitanje3pp1pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_3_pp_1_pp_2", type="string", length=20, nullable=true)
     */
    protected $pitanje3pp1pp2;

    /**
     * @var string $pitanje4pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_4_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje4pp1;

    /**
     * @var string $pitanje5pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_5_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje5pp1;

    /**
     * @var string $pitanje6pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_6_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje6pp1;

    /**
     * @var string $pitanje7pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje7pp1;

    /**
     * @var string $pitanje7pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7_pp_2", type="string", length=20, nullable=true)
     */
    protected $pitanje7pp2;

    /**
     * @var string $pitanje7pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7_pp_3", type="string", length=20, nullable=true)
     */
    protected $pitanje7pp3;

    /**
     * @var string $pitanje8pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp1;

    /**
     * @var string $pitanje8pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_2", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp2;

    /**
     * @var string $pitanje8pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_3", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp3;

    /**
     * @var string $pitanje8pp4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_4", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp4;

    /**
     * @var string $pitanje8pp5
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_5", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp5;

    /**
     * @var string $pitanje8pp6
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_6", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp6;

    /**
     * @var string $pitanje8pp7
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_7", type="string", length=20, nullable=true)
     */
    protected $pitanje8pp7;

    /**
     * @var string $pitanje9pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_9_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje9pp1;

    /**
     * @var string $pitanje9pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_9_pp_2", type="string", length=20, nullable=true)
     */
    protected $pitanje9pp2;

    /**
     * @var string $pitanje9pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_9_pp_3", type="string", length=20, nullable=true)
     */
    protected $pitanje9pp3;

    /**
     * @var string $pitanje10pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_10_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje10pp1;

    /**
     * @var string $pitanje10pp2pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_10_pp_2_pp_1", type="string", length=20, nullable=true)
     */
    protected $pitanje10pp2pp1;

    /**
     * @var string $pitanje10pp2pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_10_pp_2_pp_2", type="string", length=20, nullable=true)
     */
    protected $pitanje10pp2pp2;

    /**
     * @var string $pitanje10pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_10_pp_3", type="string", length=20, nullable=true)
     */
    protected $pitanje10pp3;

    /**
     * @var string $odobrenoUgovorom1
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_ugovorom_1", type="string", length=20, nullable=true)
     */
    protected $odobrenoUgovorom1;

    /**
     * @var string $odobrenoUgovorom2
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_ugovorom_2", type="string", length=20, nullable=true)
     */
    protected $odobrenoUgovorom2;

    /**
     * @var string $odobrenoUgovorom3
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_ugovorom_3", type="string", length=20, nullable=true)
     */
    protected $odobrenoUgovorom3;

    /**
     * @var string $odobrenoUgovorom4
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_ugovorom_4", type="string", length=20, nullable=true)
     */
    protected $odobrenoUgovorom4;

    /**
     * @var string $odobrenoUgovorom5
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_ugovorom_5", type="string", length=20, nullable=true)
     */
    protected $odobrenoUgovorom5;

    /**
     * @var string $odobrenoUgovorom6
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_ugovorom_6", type="string", length=20, nullable=true)
     */
    protected $odobrenoUgovorom6;

    /**
     * @var string $nakonRealokacija1
     * @Assert\Type("string")
     * @ORM\Column(name="nakon_realokacija_1", type="string", length=20, nullable=true)
     */
    protected $nakonRealokacija1;

    /**
     * @var string $nakonRealokacija2
     * @Assert\Type("string")
     * @ORM\Column(name="nakon_realokacija_2", type="string", length=20, nullable=true)
     */
    protected $nakonRealokacija2;

    /**
     * @var string $nakonRealokacija3
     * @Assert\Type("string")
     * @ORM\Column(name="nakon_realokacija_3", type="string", length=20, nullable=true)
     */
    protected $nakonRealokacija3;

    /**
     * @var string $nakonRealokacija4
     * @Assert\Type("string")
     * @ORM\Column(name="nakon_realokacija_4", type="string", length=20, nullable=true)
     */
    protected $nakonRealokacija4;

    /**
     * @var string $nakonRealokacija5
     * @Assert\Type("string")
     * @ORM\Column(name="nakon_realokacija_5", type="string", length=20, nullable=true)
     */
    protected $nakonRealokacija5;

    /**
     * @var string $nakonRealokacija6
     * @Assert\Type("string")
     * @ORM\Column(name="nakon_realokacija_6", type="string", length=20, nullable=true)
     */
    protected $nakonRealokacija6;

    /**
     * @var string $zavrsnomIzvestaju1
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsnom_izvestaju_1", type="string", length=20, nullable=true)
     */
    protected $zavrsnomIzvestaju1;

    /**
     * @var string $zavrsnomIzvestaju2
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsnom_izvestaju_2", type="string", length=20, nullable=true)
     */
    protected $zavrsnomIzvestaju2;

    /**
     * @var string $zavrsnomIzvestaju3
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsnom_izvestaju_3", type="string", length=20, nullable=true)
     */
    protected $zavrsnomIzvestaju3;

    /**
     * @var string $zavrsnomIzvestaju4
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsnom_izvestaju_4", type="string", length=20, nullable=true)
     */
    protected $zavrsnomIzvestaju4;

    /**
     * @var string $zavrsnomIzvestaju5
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsnom_izvestaju_5", type="string", length=20, nullable=true)
     */
    protected $zavrsnomIzvestaju5;

    /**
     * @var string $zavrsnomIzvestaju6
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsnom_izvestaju_6", type="string", length=20, nullable=true)
     */
    protected $zavrsnomIzvestaju6;

    /**
     * @var string $odobrenihUgovorom1
     * @Assert\Type("string")
     * @ORM\Column(name="odobrenih_ugovorom_1", type="string", length=20, nullable=true)
     */
    protected $odobrenihUgovorom1;

    /**
     * @var string $odobrenihUgovorom2
     * @Assert\Type("string")
     * @ORM\Column(name="odobrenih_ugovorom_2", type="string", length=20, nullable=true)
     */
    protected $odobrenihUgovorom2;

    /**
     * @var string $odobrenihUgovorom3
     * @Assert\Type("string")
     * @ORM\Column(name="odobrenih_ugovorom_3", type="string", length=20, nullable=true)
     */
    protected $odobrenihUgovorom3;

    /**
     * @var string $odobrenihUgovorom4
     * @Assert\Type("string")
     * @ORM\Column(name="odobrenih_ugovorom_4", type="string", length=20, nullable=true)
     */
    protected $odobrenihUgovorom4;

    /**
     * @var string $odobrenihUgovorom5
     * @Assert\Type("string")
     * @ORM\Column(name="odobrenih_ugovorom_5", type="string", length=20, nullable=true)
     */
    protected $odobrenihUgovorom5;

    /**
     * @var string $odobrenihUgovorom6
     * @Assert\Type("string")
     * @ORM\Column(name="odobrenih_ugovorom_6", type="string", length=20, nullable=true)
     */
    protected $odobrenihUgovorom6;

    /**
     * @var string $zatrazenihZavrsimIzvescem1
     * @Assert\Type("string")
     * @ORM\Column(name="zatrazenih_zavrsim_izvescem_1", type="string", length=20, nullable=true)
     */
    protected $zatrazenihZavrsimIzvescem1;

    /**
     * @var string $zatrazenihZavrsimIzvescem2
     * @Assert\Type("string")
     * @ORM\Column(name="zatrazenih_zavrsim_izvescem_2", type="string", length=20, nullable=true)
     */
    protected $zatrazenihZavrsimIzvescem2;

    /**
     * @var string $zatrazenihZavrsimIzvescem3
     * @Assert\Type("string")
     * @ORM\Column(name="zatrazenih_zavrsim_izvescem_3", type="string", length=20, nullable=true)
     */
    protected $zatrazenihZavrsimIzvescem3;

    /**
     * @var string $zatrazenihZavrsimIzvescem4
     * @Assert\Type("string")
     * @ORM\Column(name="zatrazenih_zavrsim_izvescem_4", type="string", length=20, nullable=true)
     */
    protected $zatrazenihZavrsimIzvescem4;

    /**
     * @var string $zatrazenihZavrsimIzvescem5
     * @Assert\Type("string")
     * @ORM\Column(name="zatrazenih_zavrsim_izvescem_5", type="string", length=20, nullable=true)
     */
    protected $zatrazenihZavrsimIzvescem5;

    /**
     * @var string $zatrazenihZavrsimIzvescem6
     * @Assert\Type("string")
     * @ORM\Column(name="zatrazenih_zavrsim_izvescem_6", type="string", length=20, nullable=true)
     */
    protected $zatrazenihZavrsimIzvescem6;

    /**
     * @var string $danaNakonZavrsnogIzvesca1
     * @Assert\Type("string")
     * @ORM\Column(name="dana_nakon_zavrsnog_izvesca_1", type="string", length=20, nullable=true)
     */
    protected $danaNakonZavrsnogIzvesca1;

    /**
     * @var string $danaNakonZavrsnogIzvesca2
     * @Assert\Type("string")
     * @ORM\Column(name="dana_nakon_zavrsnog_izvesca_2", type="string", length=20, nullable=true)
     */
    protected $danaNakonZavrsnogIzvesca2;

    /**
     * @var string $danaNakonZavrsnogIzvesca3
     * @Assert\Type("string")
     * @ORM\Column(name="dana_nakon_zavrsnog_izvesca_3", type="string", length=20, nullable=true)
     */
    protected $danaNakonZavrsnogIzvesca3;

    /**
     * @var string $danaNakonZavrsnogIzvesca4
     * @Assert\Type("string")
     * @ORM\Column(name="dana_nakon_zavrsnog_izvesca_4", type="string", length=20, nullable=true)
     */
    protected $danaNakonZavrsnogIzvesca4;

    /**
     * @var string $danaNakonZavrsnogIzvesca5
     * @Assert\Type("string")
     * @ORM\Column(name="dana_nakon_zavrsnog_izvesca_5", type="string", length=20, nullable=true)
     */
    protected $danaNakonZavrsnogIzvesca5;

    /**
     * @var string $danaNakonZavrsnogIzvesca6
     * @Assert\Type("string")
     * @ORM\Column(name="dana_nakon_zavrsnog_izvesca_6", type="string", length=20, nullable=true)
     */
    protected $danaNakonZavrsnogIzvesca6;

    /**
     * @var string $odobrenoZavrsnogIzvesca1
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_zavrsnog_izvesca_1", type="string", length=20, nullable=true)
     */
    protected $odobrenoZavrsnogIzvesca1;

    /**
     * @var string $odobrenoZavrsnogIzvesca2
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_zavrsnog_izvesca_2", type="string", length=20, nullable=true)
     */
    protected $odobrenoZavrsnogIzvesca2;

    /**
     * @var string $odobrenoZavrsnogIzvesca3
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_zavrsnog_izvesca_3", type="string", length=20, nullable=true)
     */
    protected $odobrenoZavrsnogIzvesca3;

    /**
     * @var string $odobrenoZavrsnogIzvesca4
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_zavrsnog_izvesca_4", type="string", length=20, nullable=true)
     */
    protected $odobrenoZavrsnogIzvesca4;

    /**
     * @var string $odobrenoZavrsnogIzvesca5
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_zavrsnog_izvesca_5", type="string", length=20, nullable=true)
     */
    protected $odobrenoZavrsnogIzvesca5;

    /**
     * @var string $odobrenoZavrsnogIzvesca6
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_zavrsnog_izvesca_6", type="string", length=20, nullable=true)
     */
    protected $odobrenoZavrsnogIzvesca6;

    /**
     * @var string $finansijskaKorelacija1
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija_1", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija1;

    /**
     * @var string $finansijskaKorelacija2
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija_2", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija2;

    /**
     * @var string $finansijskaKorelacija3
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija_3", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija3;

    /**
     * @var string $finansijskaKorelacija4
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija_4", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija4;

    /**
     * @var string $finansijskaKorelacija5
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija_5", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija5;

    /**
     * @var string $finansijskaKorelacija6
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija_6", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija6;

    /**
     * @var string $ukupnoDoSadaUpalceno
     * @Assert\Type("string")
     * @ORM\Column(name="ukupno_do_sada_upalceno", type="string", length=20, nullable=true)
     */
    protected $ukupnoDoSadaUpalceno;

    /**
     * @var string $preostaloZaIsplatu
     * @Assert\Type("string")
     * @ORM\Column(name="preostalo_za_isplatu", type="string", length=20, nullable=true)
     */
    protected $preostaloZaIsplatu;

    /**
     * @var string $preostaloZaPovrat
     * @Assert\Type("string")
     * @ORM\Column(name="preostalo_za_povrat", type="string", length=20, nullable=true)
     */
    protected $preostaloZaPovrat;

    /**
     * @var string $finansijskaKorelacija
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korelacija", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorelacija;

    /**
     * @var string $komentarObrade
     * @Assert\Type("string")
     * @ORM\Column(name="komentar_obrade", type="text", nullable=true)
     */
    protected $komentarObrade;

    /**
     * @var string $smanjenjeGranta
     * @Assert\Type("string")
     * @ORM\Column(name="smanjenje_granta", type="string", length=20, nullable=true)
     */
    protected $smanjenjeGranta;

    /**
     * @var string $preostaloZaZavrsnuIsplatu
     * @Assert\Type("string")
     * @ORM\Column(name="preostalo_za_zavrsnu_isplatu", type="string", length=20, nullable=true)
     */
    protected $preostaloZaZavrsnuIsplatu;

    /**
     * @var string $preostaloZaPovracaj
     * @Assert\Type("string")
     * @ORM\Column(name="preostalo_za_povracaj", type="string", length=20, nullable=true)
     */
    protected $preostaloZaPovracaj;

    /**
     * @var string $komentarPreporukeZaKorisnika
     * @Assert\Type("string")
     * @ORM\Column(name="komentar_preporuke_za_korisnika", type="text", nullable=true)
     */
    protected $komentarPreporukeZaKorisnika;

    /**
     * @var string $vrstaProjekta
     * @Assert\Type("string")
     * @ORM\Column(name="vrsta_projekta", type="string", length=30, nullable=true)
     */
    protected $vrstaProjekta;

    /**
     * @var string $nazivKorisnika
     * @Assert\Type("string")
     * @ORM\Column(name="naziv_korisnika", type="string", length=30, nullable=true)
     */
    protected $nazivKorisnika;

    /**
     * @var string $psredisteOrganizacije
     * @Assert\Type("string")
     * @ORM\Column(name="srediste_organizacije", type="string", length=30, nullable=true)
     */
    protected $sredisteOrganizacije;

    /**
     * @ORM\Column(name="datum_povere", type="date", nullable=true)
     */
    protected $datumProvere;

    /**
     * @var string $referentniBroj
     * @Assert\Type("string")
     * @ORM\Column(name="referentni_broj", type="string", length=30, nullable=true)
     */
    protected $referentniBroj;

    /**
     * @var string $nazivProjekta
     * @Assert\Type("string")
     * @ORM\Column(name="naziv_projekta", type="string", length=50, nullable=true)
     */
    protected $nazivProjekta;

    /**
     * @var string $potpis
     * @Assert\Type("string")
     * @ORM\Column(name="potpis", type="string", length=30, nullable=true)
     */
    protected $potpis;

    /**
     * @var string $propisanomObrascu
     * @Assert\Type("string")
     * @ORM\Column(name="propisanom_obrascu", type="string", length=10, nullable=true)
     */
    protected $propisanomObrascu;
    /**
     * @var string $predatURoku
     * @Assert\Type("string")
     * @ORM\Column(name="predat_u_roku", type="string", length=10, nullable=true)
     */
    protected $predatURoku;

    /**
     * @var string $ispunjenUCelosti
     * @Assert\Type("string")
     * @ORM\Column(name="ispunjen_u_celosti", type="string", length=10, nullable=true)
     */
    protected $ispunjenUCelosti;

    /**
     * @var string $ispunjenNaJezikuZavrsnogIzvestaja
     * @Assert\Type("string")
     * @ORM\Column(name="ispunjen_na_jeziku_zavrsnog_izvestaja", type="string", length=10, nullable=true)
     */
    protected $ispunjenNaJezikuZavrsnogIzvestaja;

    /**
     * @var string $prilozenaIzjava
     * @Assert\Type("string")
     * @ORM\Column(name="prilozena_izjava", type="string", length=10, nullable=true)
     */
    protected $prilozenaIzjava;

    /**
     * @var string $rasporedAktivnosti
     * @Assert\Type("string")
     * @ORM\Column(name="raspored_aktivnosti", type="string", length=10, nullable=true)
     */
    protected $rasporedAktivnosti;

    /**
     * @var string $izvestajJeFormalno
     * @Assert\Type("string")
     * @ORM\Column(name="izvestaj_je_formalno", type="string", length=20, nullable=true)
     */
    protected $izvestajJeFormalno;


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
    public function getPitanje10()
    {
        return $this->pitanje10;
    }

    /**
     * @param mixed $pitanje10
     */
    public function setPitanje10($pitanje10)
    {
        $this->pitanje9 = $pitanje10;
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

    /**
     * @return mixed
     */
    public function getReportingType()
    {
        return $this->reportingType;
    }

    /**
     * @param mixed $reportingType
     */
    public function setReportingType($reportingType)
    {
        $this->reportingType = $reportingType;
    }

    /**
     * @return mixed
     */
    public function getPitanje1051()
    {
        return $this->pitanje_105_1;
    }

    /**
     * @param mixed $pitanje_105_1
     */
    public function setPitanje1051($pitanje_105_1)
    {
        $this->pitanje_105_1 = $pitanje_105_1;
    }

    /**
     * @return mixed
     */
    public function getPitanje10511()
    {
        return $this->pitanje_105_1_1;
    }

    /**
     * @param mixed $pitanje_105_1_1
     */
    public function setPitanje10511($pitanje_105_1_1)
    {
        $this->pitanje_105_1_1 = $pitanje_105_1_1;
    }

    /**
     * @return mixed
     */
    public function getPitanje1052()
    {
        return $this->pitanje_105_2;
    }

    /**
     * @param mixed $pitanje_105_2
     */
    public function setPitanje1052($pitanje_105_2)
    {
        $this->pitanje_105_2 = $pitanje_105_2;
    }

    /**
     * @return mixed
     */
    public function getPitanje10521()
    {
        return $this->pitanje_105_2_1;
    }

    /**
     * @param mixed $pitanje_105_2_1
     */
    public function setPitanje10521($pitanje_105_2_1)
    {
        $this->pitanje_105_2_1 = $pitanje_105_2_1;
    }

    /**
     * @return mixed
     */
    public function getPitanje1054()
    {
        return $this->pitanje_105_4;
    }

    /**
     * @param mixed $pitanje_105_4
     */
    public function setPitanje1054($pitanje_105_4)
    {
        $this->pitanje_105_4 = $pitanje_105_4;
    }

    /**
     * @return mixed
     */
    public function getPitanje10513()
    {
        return $this->pitanje_105_13;
    }

    /**
     * @param mixed $pitanje_105_13
     */
    public function setPitanje10513 ($pitanje_105_13)
    {
        $this->pitanje_105_13 = $pitanje_105_13;
    }

    /**
     * @return mixed
     */
    public function getPitanje10514()
    {
        return $this->pitanje_105_14;
    }

    /**
     * @param mixed $pitanje_105_14
     */
    public function setPitanje10514 ($pitanje_105_14)
    {
        $this->pitanje_105_14 = $pitanje_105_14;
    }

    /**
     * @return mixed
     */
    public function getUlazakIzvestaja()
    {
        return $this->ulazakIzvestaja;
    }

    /**
     * @param mixed $ulazakIzvestaja
     */
    public function setUlazakIzvestaja($ulazakIzvestaja)
    {
        $this->ulazakIzvestaja = $ulazakIzvestaja;
    }

    /**
     * @return mixed
     */
    public function getProveruIzvrsio()
    {
        return $this->proveruIzvrsio;
    }

    /**
     * @param mixed $proveruIzvrsio
     */
    public function setProveruIzvrsio ($proveruIzvrsio)
    {
        $this->proveruIzvrsio = $proveruIzvrsio;
    }

    /**
     * @return mixed
     */
    public function getPotpunaFinansijskaDokumentacija()
    {
        return $this->potpunaFinansijskaDokumentacija;
    }

    /**
     * @param mixed $potpunaFinansijskaDokumentacija
     */
    public function setPotpunaFinansijskaDokumentacija ($potpunaFinansijskaDokumentacija)
    {
        $this->potpunaFinansijskaDokumentacija = $potpunaFinansijskaDokumentacija;
    }

    /**
     * @return mixed
     */
    public function getDatumPosete()
    {
        return $this->datumPosete;
    }

    /**
     * @param mixed $datumPosete
     */
    public function setDatumPosete($datumPosete)
    {
        $this->datumPosete = $datumPosete;
    }

    /**
     * @return mixed
     */
    public function getDokumentPregledao()
    {
        return $this->dokumentPregledao;
    }

    /**
     * @param mixed $dokumentPregledao
     */
    public function setDokumentPregledao($dokumentPregledao)
    {
        $this->dokumentPregledao = $dokumentPregledao;
    }

    /**
     * @return mixed
     */
    public function getPotpunaDodatnaDokumentacija()
    {
        return $this->potpunaDodatnaDokumentacija;
    }

    /**
     * @param mixed $potpunaDodatnaDokumentacija
     */
    public function setPotpunaDodatnaDokumentacija ($potpunaDodatnaDokumentacija)
    {
        $this->potpunaDodatnaDokumentacija = $potpunaDodatnaDokumentacija;
    }

    /**
     * @return mixed
     */
    public function getRazlogNepotpuneDokumentacije()
    {
        return $this->razlogNepotpuneDokumentacije;
    }

    /**
     * @param mixed $razlogNepotpuneDokumentacije
     */
    public function setRazlogNepotpuneDokumentacije ($razlogNepotpuneDokumentacije)
    {
        $this->razlogNepotpuneDokumentacije = $razlogNepotpuneDokumentacije;
    }

    /**
     * @return mixed
     */
    public function getDatumTrazenjaDodatneDokumentacije()
    {
        return $this->datumTrazenjaDodatneDokumentacije;
    }

    /**
     * @param mixed $datumTrazenjaDodatneDokumentacije
     */
    public function setDatumTrazenjaDodatneDokumentacije($datumTrazenjaDodatneDokumentacije)
    {
        $this->datumTrazenjaDodatneDokumentacije = $datumTrazenjaDodatneDokumentacije;
    }

    /**
     * @return mixed
     */
    public function getDatumDostavljanjaDodatneDokumentacije()
    {
        return $this->datumDostavljanjaDodatneDokumentacije;
    }

    /**
     * @param mixed $datumDostavljanjaDodatneDokumentacije
     */
    public function setDatumDostavljanjaDodatneDokumentacije($datumDostavljanjaDodatneDokumentacije)
    {
        $this->datumDostavljanjaDodatneDokumentacije = $datumDostavljanjaDodatneDokumentacije;
    }

    /**
     * @return mixed
     */
    public function getApsorbovatiAlociranBudzet()
    {
        return $this->apsorbovatiAlociranBudzet;
    }

    /**
     * @param mixed $apsorbovatiAlociranBudzet
     */
    public function setApsorbovatiAlociranBudzet ($apsorbovatiAlociranBudzet)
    {
        $this->apsorbovatiAlociranBudzet = $apsorbovatiAlociranBudzet;
    }

    /**
     * @return mixed
     */
    public function getDatumZavrsetkaObrade()
    {
        return $this->datumZavrsetkaObrade;
    }

    /**
     * @param mixed $datumZavrsetkaObrade
     */
    public function setDatumZavrsetkaObrade($datumZavrsetkaObrade)
    {
        $this->datumZavrsetkaObrade = $datumZavrsetkaObrade;
    }

    /**
     * @return mixed
     */
    public function getPitanje1pp1()
    {
        return $this->pitanje1pp1;
    }

    /**
     * @param mixed $pitanje1pp1
     */
    public function setPitanje1pp1 ($pitanje1pp1)
    {
        $this->pitanje1pp1 = $pitanje1pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje3pp1pp1()
    {
        return $this->pitanje3pp1pp1;
    }

    /**
     * @param mixed $pitanje3pp1pp1
     */
    public function setPitanje3pp1pp1 ($pitanje3pp1pp1)
    {
        $this->pitanje3pp1pp1 = $pitanje3pp1pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje4pp1()
    {
        return $this->pitanje4pp1;
    }

    /**
     * @param mixed $pitanje4pp1
     */
    public function setPitanje4pp1 ($pitanje4pp1)
    {
        $this->pitanje4pp1 = $pitanje4pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje5pp1()
    {
        return $this->pitanje5pp1;
    }

    /**
     * @param mixed $pitanje5pp1
     */
    public function setPitanje5pp1 ($pitanje5pp1)
    {
        $this->pitanje5pp1 = $pitanje5pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje6pp1()
    {
        return $this->pitanje6pp1;
    }

    /**
     * @param mixed $pitanje6pp1
     */
    public function setPitanje6pp1 ($pitanje6pp1)
    {
        $this->pitanje6pp1 = $pitanje6pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje7pp1()
    {
        return $this->pitanje7pp1;
    }

    /**
     * @param mixed $pitanje7pp1
     */
    public function setPitanje7pp1 ($pitanje7pp1)
    {
        $this->pitanje7pp1 = $pitanje7pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje7pp2()
    {
        return $this->pitanje7pp2;
    }

    /**
     * @param mixed $pitanje7pp2
     */
    public function setPitanje7pp2 ($pitanje7pp2)
    {
        $this->pitanje7pp2 = $pitanje7pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje7pp3()
    {
        return $this->pitanje7pp3;
    }

    /**
     * @param mixed $pitanje7pp3
     */
    public function setPitanje7pp3 ($pitanje7pp3)
    {
        $this->pitanje7pp3 = $pitanje7pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp1()
    {
        return $this->pitanje8pp1;
    }

    /**
     * @param mixed $pitanje8pp1
     */
    public function setPitanje8pp1 ($pitanje8pp1)
    {
        $this->pitanje8pp1 = $pitanje8pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp2()
    {
        return $this->pitanje8pp2;
    }

    /**
     * @param mixed $pitanje8pp2
     */
    public function setPitanje8pp2 ($pitanje8pp2)
    {
        $this->pitanje8pp2 = $pitanje8pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp3()
    {
        return $this->pitanje8pp3;
    }

    /**
     * @param mixed $pitanje8pp3
     */
    public function setPitanje8pp3 ($pitanje8pp3)
    {
        $this->pitanje8pp3 = $pitanje8pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp4()
    {
        return $this->pitanje8pp4;
    }

    /**
     * @param mixed $pitanje8pp4
     */
    public function setPitanje8pp4 ($pitanje8pp4)
    {
        $this->pitanje8pp4 = $pitanje8pp4;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp5()
    {
        return $this->pitanje8pp5;
    }

    /**
     * @param mixed $pitanje8pp5
     */
    public function setPitanje8pp5 ($pitanje8pp5)
    {
        $this->pitanje8pp5 = $pitanje8pp5;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoUgovorom1()
    {
        return $this->odobrenoUgovorom1;
    }

    /**
     * @param mixed $odobrenoUgovorom1
     */
    public function setOdobrenoUgovorom1 ($odobrenoUgovorom1)
    {
        $this->odobrenoUgovorom1 = $odobrenoUgovorom1;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoUgovorom2()
    {
        return $this->odobrenoUgovorom2;
    }

    /**
     * @param mixed $odobrenoUgovorom2
     */
    public function setOdobrenoUgovorom2 ($odobrenoUgovorom2)
    {
        $this->odobrenoUgovorom2 = $odobrenoUgovorom2;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoUgovorom3()
    {
        return $this->odobrenoUgovorom3;
    }

    /**
     * @param mixed $odobrenoUgovorom3
     */
    public function setOdobrenoUgovorom3 ($odobrenoUgovorom3)
    {
        $this->odobrenoUgovorom3 = $odobrenoUgovorom3;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoUgovorom4()
    {
        return $this->odobrenoUgovorom4;
    }

    /**
     * @param mixed $odobrenoUgovorom4
     */
    public function setOdobrenoUgovorom4 ($odobrenoUgovorom4)
    {
        $this->odobrenoUgovorom4 = $odobrenoUgovorom4;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoUgovorom5()
    {
        return $this->odobrenoUgovorom5;
    }

    /**
     * @param mixed $odobrenoUgovorom5
     */
    public function setOdobrenoUgovorom5 ($odobrenoUgovorom5)
    {
        $this->odobrenoUgovorom5 = $odobrenoUgovorom5;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoUgovorom6()
    {
        return $this->odobrenoUgovorom6;
    }

    /**
     * @param mixed $odobrenoUgovorom6
     */
    public function setOdobrenoUgovorom6 ($odobrenoUgovorom6)
    {
        $this->odobrenoUgovorom6 = $odobrenoUgovorom6;
    }

    /**
     * @return mixed
     */
    public function getNakonRealokacija1()
    {
        return $this->nakonRealokacija1;
    }

    /**
     * @param mixed $nakonRealokacija1
     */
    public function setNakonRealokacija1 ($nakonRealokacija1)
    {
        $this->nakonRealokacija1 = $nakonRealokacija1;
    }

    /**
     * @return mixed
     */
    public function getNakonRealokacija2()
    {
        return $this->nakonRealokacija2;
    }

    /**
     * @param mixed $nakonRealokacija2
     */
    public function setNakonRealokacija2 ($nakonRealokacija2)
    {
        $this->nakonRealokacija2 = $nakonRealokacija2;
    }

    /**
     * @return mixed
     */
    public function getNakonRealokacija3()
    {
        return $this->nakonRealokacija3;
    }

    /**
     * @param mixed $nakonRealokacija3
     */
    public function setNakonRealokacija3 ($nakonRealokacija3)
    {
        $this->nakonRealokacija3 = $nakonRealokacija3;
    }

    /**
     * @return mixed
     */
    public function getNakonRealokacija4()
    {
        return $this->nakonRealokacija4;
    }

    /**
     * @param mixed $nakonRealokacija4
     */
    public function setNakonRealokacija4 ($nakonRealokacija4)
    {
        $this->nakonRealokacija4 = $nakonRealokacija4;
    }

    /**
     * @return mixed
     */
    public function getNakonRealokacija5()
    {
        return $this->nakonRealokacija5;
    }

    /**
     * @param mixed $nakonRealokacija5
     */
    public function setNakonRealokacija5 ($nakonRealokacija5)
    {
        $this->nakonRealokacija5 = $nakonRealokacija5;
    }

    /**
     * @return mixed
     */
    public function getNakonRealokacija6()
    {
        return $this->nakonRealokacija6;
    }

    /**
     * @param mixed $nakonRealokacija6
     */
    public function setNakonRealokacija6 ($nakonRealokacija6)
    {
        $this->nakonRealokacija6 = $nakonRealokacija6;
    }

    /**
     * @return mixed
     */
    public function getZavrsnomIzvestaju1()
    {
        return $this->zavrsnomIzvestaju1;
    }

    /**
     * @param mixed $zavrsnomIzvestaju1
     */
    public function setZavrsnomIzvestaju1 ($zavrsnomIzvestaju1)
    {
        $this->zavrsnomIzvestaju1 = $zavrsnomIzvestaju1;
    }

    /**
     * @return mixed
     */
    public function getZavrsnomIzvestaju2()
    {
        return $this->zavrsnomIzvestaju2;
    }

    /**
     * @param mixed $zavrsnomIzvestaju2
     */
    public function setZavrsnomIzvestaju2 ($zavrsnomIzvestaju2)
    {
        $this->zavrsnomIzvestaju2 = $zavrsnomIzvestaju2;
    }

    /**
     * @return mixed
     */
    public function getZavrsnomIzvestaju3()
    {
        return $this->zavrsnomIzvestaju3;
    }

    /**
     * @param mixed $zavrsnomIzvestaju3
     */
    public function setZavrsnomIzvestaju3 ($zavrsnomIzvestaju3)
    {
        $this->zavrsnomIzvestaju3 = $zavrsnomIzvestaju3;
    }

    /**
     * @return mixed
     */
    public function getZavrsnomIzvestaju4()
    {
        return $this->zavrsnomIzvestaju4;
    }

    /**
     * @param mixed $zavrsnomIzvestaju4
     */
    public function setZavrsnomIzvestaju4 ($zavrsnomIzvestaju4)
    {
        $this->zavrsnomIzvestaju4 = $zavrsnomIzvestaju4;
    }

    /**
     * @return mixed
     */
    public function getZavrsnomIzvestaju5()
    {
        return $this->zavrsnomIzvestaju5;
    }

    /**
     * @param mixed $zavrsnomIzvestaju5
     */
    public function setZavrsnomIzvestaju5 ($zavrsnomIzvestaju5)
    {
        $this->zavrsnomIzvestaju5 = $zavrsnomIzvestaju5;
    }

    /**
     * @return mixed
     */
    public function getZavrsnomIzvestaju6()
    {
        return $this->zavrsnomIzvestaju6;
    }

    /**
     * @param mixed $zavrsnomIzvestaju6
     */
    public function setZavrsnomIzvestaju6 ($zavrsnomIzvestaju6)
    {
        $this->zavrsnomIzvestaju6 = $zavrsnomIzvestaju6;
    }

    /**
     * @return mixed
     */
    public function getOdobrenihUgovorom1()
    {
        return $this->odobrenihUgovorom1;
    }

    /**
     * @param mixed $odobrenihUgovorom1
     */
    public function setOdobrenihUgovorom1 ($odobrenihUgovorom1)
    {
        $this->odobrenihUgovorom1 = $odobrenihUgovorom1;
    }

    /**
     * @return mixed
     */
    public function getOdobrenihUgovorom2()
    {
        return $this->odobrenihUgovorom2;
    }

    /**
     * @param mixed $odobrenihUgovorom2
     */
    public function setOdobrenihUgovorom2 ($odobrenihUgovorom2)
    {
        $this->odobrenihUgovorom2 = $odobrenihUgovorom2;
    }

    /**
     * @return mixed
     */
    public function getOdobrenihUgovorom3()
    {
        return $this->odobrenihUgovorom3;
    }

    /**
     * @param mixed $odobrenihUgovorom3
     */
    public function setOdobrenihUgovorom3 ($odobrenihUgovorom3)
    {
        $this->odobrenihUgovorom3 = $odobrenihUgovorom3;
    }

    /**
     * @return mixed
     */
    public function getOdobrenihUgovorom4()
    {
        return $this->odobrenihUgovorom4;
    }

    /**
     * @param mixed $odobrenihUgovorom4
     */
    public function setOdobrenihUgovorom4 ($odobrenihUgovorom4)
    {
        $this->odobrenihUgovorom4 = $odobrenihUgovorom4;
    }

    /**
     * @return mixed
     */
    public function getOdobrenihUgovorom5()
    {
        return $this->odobrenihUgovorom5;
    }

    /**
     * @param mixed $odobrenihUgovorom5
     */
    public function setOdobrenihUgovorom5 ($odobrenihUgovorom5)
    {
        $this->odobrenihUgovorom5 = $odobrenihUgovorom5;
    }

    /**
     * @return mixed
     */
    public function getOdobrenihUgovorom6()
    {
        return $this->odobrenihUgovorom6;
    }

    /**
     * @param mixed $odobrenihUgovorom6
     */
    public function setOdobrenihUgovorom6 ($odobrenihUgovorom6)
    {
        $this->odobrenihUgovorom6 = $odobrenihUgovorom6;
    }

    /**
     * @return mixed
     */
    public function getZatrazenihZavrsimIzvescem1()
    {
        return $this->zatrazenihZavrsimIzvescem1;
    }

    /**
     * @param mixed $zatrazenihZavrsimIzvescem1
     */
    public function setZatrazenihZavrsimIzvescem1 ($zatrazenihZavrsimIzvescem1)
    {
        $this->zatrazenihZavrsimIzvescem1 = $zatrazenihZavrsimIzvescem1;
    }

    /**
     * @return mixed
     */
    public function getZatrazenihZavrsimIzvescem2()
    {
        return $this->zatrazenihZavrsimIzvescem2;
    }

    /**
     * @param mixed $zatrazenihZavrsimIzvescem2
     */
    public function setZatrazenihZavrsimIzvescem2 ($zatrazenihZavrsimIzvescem2)
    {
        $this->zatrazenihZavrsimIzvescem2 = $zatrazenihZavrsimIzvescem2;
    }

    /**
     * @return mixed
     */
    public function getZatrazenihZavrsimIzvescem3()
    {
        return $this->zatrazenihZavrsimIzvescem3;
    }

    /**
     * @param mixed $zatrazenihZavrsimIzvescem3
     */
    public function setZatrazenihZavrsimIzvescem3 ($zatrazenihZavrsimIzvescem3)
    {
        $this->zatrazenihZavrsimIzvescem3 = $zatrazenihZavrsimIzvescem3;
    }

    /**
     * @return mixed
     */
    public function getZatrazenihZavrsimIzvescem4()
    {
        return $this->zatrazenihZavrsimIzvescem4;
    }

    /**
     * @param mixed $zatrazenihZavrsimIzvescem4
     */
    public function setZatrazenihZavrsimIzvescem4 ($zatrazenihZavrsimIzvescem4)
    {
        $this->zatrazenihZavrsimIzvescem4 = $zatrazenihZavrsimIzvescem4;
    }

    /**
     * @return mixed
     */
    public function getZatrazenihZavrsimIzvescem5()
    {
        return $this->zatrazenihZavrsimIzvescem5;
    }

    /**
     * @param mixed $zatrazenihZavrsimIzvescem5
     */
    public function setZatrazenihZavrsimIzvescem5 ($zatrazenihZavrsimIzvescem5)
    {
        $this->zatrazenihZavrsimIzvescem5 = $zatrazenihZavrsimIzvescem5;
    }

    /**
     * @return mixed
     */
    public function getZatrazenihZavrsimIzvescem6()
    {
        return $this->zatrazenihZavrsimIzvescem6;
    }

    /**
     * @param mixed $zatrazenihZavrsimIzvescem6
     */
    public function setZatrazenihZavrsimIzvescem6 ($zatrazenihZavrsimIzvescem6)
    {
        $this->zatrazenihZavrsimIzvescem6 = $zatrazenihZavrsimIzvescem6;
    }

    /**
     * @return mixed
     */
    public function getDanaNakonZavrsnogIzvesca1()
    {
        return $this->danaNakonZavrsnogIzvesca1;
    }

    /**
     * @param mixed $danaNakonZavrsnogIzvesca1
     */
    public function setDanaNakonZavrsnogIzvesca1 ($danaNakonZavrsnogIzvesca1)
    {
        $this->danaNakonZavrsnogIzvesca1 = $danaNakonZavrsnogIzvesca1;
    }

    /**
     * @return mixed
     */
    public function getDanaNakonZavrsnogIzvesca2()
    {
        return $this->danaNakonZavrsnogIzvesca2;
    }

    /**
     * @param mixed $danaNakonZavrsnogIzvesca2
     */
    public function setDanaNakonZavrsnogIzvesca2 ($danaNakonZavrsnogIzvesca2)
    {
        $this->danaNakonZavrsnogIzvesca2 = $danaNakonZavrsnogIzvesca2;
    }

    /**
     * @return mixed
     */
    public function getDanaNakonZavrsnogIzvesca3()
    {
        return $this->danaNakonZavrsnogIzvesca3;
    }

    /**
     * @param mixed $danaNakonZavrsnogIzvesca3
     */
    public function setDanaNakonZavrsnogIzvesca3 ($danaNakonZavrsnogIzvesca3)
    {
        $this->danaNakonZavrsnogIzvesca3 = $danaNakonZavrsnogIzvesca3;
    }

    /**
     * @return mixed
     */
    public function getDanaNakonZavrsnogIzvesca4()
    {
        return $this->danaNakonZavrsnogIzvesca4;
    }

    /**
     * @param mixed $danaNakonZavrsnogIzvesca4
     */
    public function setDanaNakonZavrsnogIzvesca4 ($danaNakonZavrsnogIzvesca4)
    {
        $this->danaNakonZavrsnogIzvesca4 = $danaNakonZavrsnogIzvesca4;
    }

    /**
     * @return mixed
     */
    public function getDanaNakonZavrsnogIzvesca5()
    {
        return $this->danaNakonZavrsnogIzvesca5;
    }

    /**
     * @param mixed $danaNakonZavrsnogIzvesca5
     */
    public function setDanaNakonZavrsnogIzvesca5 ($danaNakonZavrsnogIzvesca5)
    {
        $this->danaNakonZavrsnogIzvesca5 = $danaNakonZavrsnogIzvesca5;
    }

    /**
     * @return mixed
     */
    public function getDanaNakonZavrsnogIzvesca6()
    {
        return $this->danaNakonZavrsnogIzvesca6;
    }

    /**
     * @param mixed $danaNakonZavrsnogIzvesca6
     */
    public function setDanaNakonZavrsnogIzvesca6 ($danaNakonZavrsnogIzvesca6)
    {
        $this->danaNakonZavrsnogIzvesca6 = $danaNakonZavrsnogIzvesca6;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoZavrsnogIzvesca1()
    {
        return $this->odobrenoZavrsnogIzvesca1;
    }

    /**
     * @param mixed $odobrenoZavrsnogIzvesca1
     */
    public function setOdobrenoZavrsnogIzvesca1 ($odobrenoZavrsnogIzvesca1)
    {
        $this->odobrenoZavrsnogIzvesca1 = $odobrenoZavrsnogIzvesca1;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoZavrsnogIzvesca2()
    {
        return $this->odobrenoZavrsnogIzvesca2;
    }

    /**
     * @param mixed $odobrenoZavrsnogIzvesca2
     */
    public function setOdobrenoZavrsnogIzvesca2 ($odobrenoZavrsnogIzvesca2)
    {
        $this->odobrenoZavrsnogIzvesca2 = $odobrenoZavrsnogIzvesca2;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoZavrsnogIzvesca3()
    {
        return $this->odobrenoZavrsnogIzvesca3;
    }

    /**
     * @param mixed $odobrenoZavrsnogIzvesca3
     */
    public function setOdobrenoZavrsnogIzvesca3 ($odobrenoZavrsnogIzvesca3)
    {
        $this->odobrenoZavrsnogIzvesca3 = $odobrenoZavrsnogIzvesca3;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoZavrsnogIzvesca4()
    {
        return $this->odobrenoZavrsnogIzvesca4;
    }

    /**
     * @param mixed $odobrenoZavrsnogIzvesca4
     */
    public function setOdobrenoZavrsnogIzvesca4 ($odobrenoZavrsnogIzvesca4)
    {
        $this->odobrenoZavrsnogIzvesca4 = $odobrenoZavrsnogIzvesca4;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoZavrsnogIzvesca5()
    {
        return $this->odobrenoZavrsnogIzvesca5;
    }

    /**
     * @param mixed $odobrenoZavrsnogIzvesca5
     */
    public function setOdobrenoZavrsnogIzvesca5 ($odobrenoZavrsnogIzvesca5)
    {
        $this->odobrenoZavrsnogIzvesca5 = $odobrenoZavrsnogIzvesca5;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoZavrsnogIzvesca6()
    {
        return $this->odobrenoZavrsnogIzvesca6;
    }

    /**
     * @param mixed $odobrenoZavrsnogIzvesca6
     */
    public function setOdobrenoZavrsnogIzvesca6 ($odobrenoZavrsnogIzvesca6)
    {
        $this->odobrenoZavrsnogIzvesca6 = $odobrenoZavrsnogIzvesca6;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija1()
    {
        return $this->finansijskaKorelacija1;
    }

    /**
     * @param mixed $finansijskaKorelacija1
     */
    public function setFinansijskaKorelacija1 ($finansijskaKorelacija1)
    {
        $this->finansijskaKorelacija1 = $finansijskaKorelacija1;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija2()
    {
        return $this->finansijskaKorelacija2;
    }

    /**
     * @param mixed $finansijskaKorelacija2
     */
    public function setFinansijskaKorelacija2 ($finansijskaKorelacija2)
    {
        $this->finansijskaKorelacija2 = $finansijskaKorelacija2;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija3()
    {
        return $this->finansijskaKorelacija3;
    }

    /**
     * @param mixed $finansijskaKorelacija3
     */
    public function setFinansijskaKorelacija3 ($finansijskaKorelacija3)
    {
        $this->finansijskaKorelacija3 = $finansijskaKorelacija3;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija4()
    {
        return $this->finansijskaKorelacija4;
    }

    /**
     * @param mixed $finansijskaKorelacija4
     */
    public function setFinansijskaKorelacija4 ($finansijskaKorelacija4)
    {
        $this->finansijskaKorelacija4 = $finansijskaKorelacija4;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija5()
    {
        return $this->finansijskaKorelacija5;
    }

    /**
     * @param mixed $finansijskaKorelacija5
     */
    public function setFinansijskaKorelacija5 ($finansijskaKorelacija5)
    {
        $this->finansijskaKorelacija5 = $finansijskaKorelacija5;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija6()
    {
        return $this->finansijskaKorelacija6;
    }

    /**
     * @param mixed $finansijskaKorelacija6
     */
    public function setFinansijskaKorelacija6 ($finansijskaKorelacija6)
    {
        $this->finansijskaKorelacija6 = $finansijskaKorelacija6;
    }

    /**
     * @return mixed
     */
    public function getUkupnoDoSadaUpalceno()
    {
        return $this->ukupnoDoSadaUpalceno;
    }

    /**
     * @param mixed $ukupnoDoSadaUpalceno
     */
    public function setUkupnoDoSadaUpalceno ($ukupnoDoSadaUpalceno)
    {
        $this->ukupnoDoSadaUpalceno = $ukupnoDoSadaUpalceno;
    }

    /**
     * @return mixed
     */
    public function getPreostaloZaIsplatu()
    {
        return $this->preostaloZaIsplatu;
    }

    /**
     * @param mixed $preostaloZaIsplatu
     */
    public function setPreostaloZaIsplatu ($preostaloZaIsplatu)
    {
        $this->preostaloZaIsplatu = $preostaloZaIsplatu;
    }

    /**
     * @return mixed
     */
    public function getPreostaloZaPovrat()
    {
        return $this->preostaloZaPovrat;
    }

    /**
     * @param mixed $preostaloZaPovrat
     */
    public function setPreostaloZaPovrat ($preostaloZaPovrat)
    {
        $this->preostaloZaPovrat = $preostaloZaPovrat;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorelacija()
    {
        return $this->finansijskaKorelacija;
    }

    /**
     * @param mixed $finansijskaKorelacija
     */
    public function setFinansijskaKorelacija ($finansijskaKorelacija)
    {
        $this->finansijskaKorelacija = $finansijskaKorelacija;
    }

    /**
     * @return mixed
     */
    public function getKomentarObrade()
    {
        return $this->komentarObrade;
    }

    /**
     * @param mixed $komentarObrade
     */
    public function setKomentarObrade ($komentarObrade)
    {
        $this->komentarObrade = $komentarObrade;
    }

    /**
     * @return mixed
     */
    public function getSmanjenjeGranta()
    {
        return $this->smanjenjeGranta;
    }

    /**
     * @param mixed $smanjenjeGranta
     */
    public function setSmanjenjeGranta ($smanjenjeGranta)
    {
        $this->smanjenjeGranta = $smanjenjeGranta;
    }

    /**
     * @return mixed
     */
    public function getPreostaloZaZavrsnuIsplatu()
    {
        return $this->preostaloZaZavrsnuIsplatu;
    }

    /**
     * @param mixed $preostaloZaZavrsnuIsplatu
     */
    public function setPreostaloZaZavrsnuIsplatu ($preostaloZaZavrsnuIsplatu)
    {
        $this->preostaloZaZavrsnuIsplatu = $preostaloZaZavrsnuIsplatu;
    }

    /**
     * @return mixed
     */
    public function getPreostaloZaPovracaj()
    {
        return $this->preostaloZaPovracaj;
    }

    /**
     * @param mixed $preostaloZaPovracaj
     */
    public function setPreostaloZaPovracaj ($preostaloZaPovracaj)
    {
        $this->preostaloZaPovracaj = $preostaloZaPovracaj;
    }

    /**
     * @return mixed
     */
    public function getPitanje3pp1pp2()
    {
        return $this->pitanje3pp1pp2;
    }

    /**
     * @param mixed $pitanje3pp1pp2
     */
    public function setPitanje3pp1pp2($pitanje3pp1pp2)
    {
        $this->pitanje3pp1pp2 = $pitanje3pp1pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje9pp1()
    {
        return $this->pitanje9pp1;
    }

    /**
     * @param mixed $pitanje9pp1
     */
    public function setPitanje9pp1($pitanje9pp1)
    {
        $this->pitanje9pp1 = $pitanje9pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje9pp2()
    {
        return $this->pitanje9pp2;
    }

    /**
     * @param mixed $pitanje9pp2
     */
    public function setPitanje9pp2($pitanje9pp2)
    {
        $this->pitanje9pp2 = $pitanje9pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje9pp3()
    {
        return $this->pitanje9pp3;
    }

    /**
     * @param mixed $pitanje9pp3
     */
    public function setPitanje9pp3($pitanje9pp3)
    {
        $this->pitanje9pp3 = $pitanje9pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje10pp1()
    {
        return $this->pitanje10pp1;
    }

    /**
     * @param mixed $pitanje10pp1
     */
    public function setPitanje10pp1($pitanje10pp1)
    {
        $this->pitanje10pp1 = $pitanje10pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje10pp2pp1()
    {
        return $this->pitanje10pp2pp1;
    }

    /**
     * @param mixed $pitanje10pp2pp1
     */
    public function setPitanje10pp2pp1($pitanje10pp2pp1)
    {
        $this->pitanje10pp2pp1 = $pitanje10pp2pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje10pp2pp2()
    {
        return $this->pitanje10pp2pp2;
    }

    /**
     * @param mixed $pitanje10pp2pp2
     */
    public function setPitanje10pp2pp2($pitanje10pp2pp2)
    {
        $this->pitanje10pp2pp2 = $pitanje10pp2pp2;
    }

    /**
     * @return mixed
     */
    public function getPitanje10pp3()
    {
        return $this->pitanje10pp3;
    }

    /**
     * @param mixed $pitanje10pp3
     */
    public function setPitanje10pp3($pitanje10pp3)
    {
        $this->pitanje10pp3 = $pitanje10pp3;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp6()
    {
        return $this->pitanje8pp6;
    }

    /**
     * @param mixed $pitanje8pp6
     */
    public function setPitanje8pp6($pitanje8pp6)
    {
        $this->pitanje8pp6 = $pitanje8pp6;
    }

    /**
     * @return mixed
     */
    public function getPitanje8pp7()
    {
        return $this->pitanje8pp7;
    }

    /**
     * @param mixed $pitanje8pp7
     */
    public function setPitanje8pp7($pitanje8pp7)
    {
        $this->pitanje8pp7 = $pitanje8pp7;
    }

    /**
     * @return mixed
     */
    public function getKomentarPreporukeZaKorisnika()
    {
        return $this->komentarPreporukeZaKorisnika;
    }

    /**
     * @param mixed $komentarPreporukeZaKorisnika
     */
    public function setKomentarPreporukeZaKorisnika( $komentarPreporukeZaKorisnika)
    {
        $this->komentarPreporukeZaKorisnika = $komentarPreporukeZaKorisnika;
    }

    /**
     * @return mixed
     */
    public function getVrstaProjekta()
    {
        return $this->vrstaProjekta;
    }

    /**
     * @param mixed $vrstaProjekta
     */
    public function setVrstaProjekta($vrstaProjekta)
    {
        $this->vrstaProjekta = $vrstaProjekta;
    }

    /**
     * @return mixed
     */
    public function getNazivKorisnika()
    {
        return $this->nazivKorisnika;
    }

    /**
     * @param mixed $nazivKorisnika
     */
    public function setNazivKorisnika($nazivKorisnika)
    {
        $this->nazivKorisnika = $nazivKorisnika;
    }

    /**
     * @return mixed
     */
    public function getSredisteOrganizacije()
    {
        return $this->sredisteOrganizacije;
    }

    /**
     * @param mixed $sredisteOrganizacije
     */
    public function setSredisteOrganizacije($sredisteOrganizacije)
    {
        $this->sredisteOrganizacije = $sredisteOrganizacije;
    }

    /**
     * @return mixed
     */
    public function getDatumProvere()
    {
        return $this->datumProvere;
    }

    /**
     * @param mixed $datumProvere
     */
    public function setDatumProvere($datumProvere)
    {
        $this->datumProvere = $datumProvere;
    }

    /**
     * @return mixed
     */
    public function getReferentniBroj()
    {
        return $this->referentniBroj;
    }

    /**
     * @param mixed $referentniBroj
     */
    public function setReferentniBroj($referentniBroj)
    {
        $this->referentniBroj = $referentniBroj;
    }

    /**
     * @return mixed
     */
    public function getNazivProjekta()
    {
        return $this->nazivProjekta;
    }

    /**
     * @param mixed $nazivProjekta
     */
    public function setNazivProjekta($nazivProjekta)
    {
        $this->nazivProjekta = $nazivProjekta;
    }

    /**
     * @return mixed
     */
    public function getPotpis()
    {
        return $this->potpis;
    }

    /**
     * @param mixed $potpis
     */
    public function setPotpis($potpis)
    {
        $this->potpis = $potpis;
    }

    /**
     * @return mixed
     */
    public function getPropisanomObrascu()
    {
        return $this->propisanomObrascu;
    }

    /**
     * @param mixed $propisanomObrascu
     */
    public function setPropisanomObrascu($propisanomObrascu)
    {
        $this->propisanomObrascu = $propisanomObrascu;
    }

    /**
     * @return mixed
     */
    public function getPredatURoku()
    {
        return $this->predatURoku;
    }

    /**
     * @param mixed $predatURoku
     */
    public function setPredatURoku($predatURoku)
    {
        $this->predatURoku = $predatURoku;
    }

    /**
     * @return mixed
     */
    public function getIspunjenUCelosti()
    {
        return $this->ispunjenUCelosti;
    }

    /**
     * @param mixed $ispunjenUCelosti
     */
    public function setIspunjenUCelosti($ispunjenUCelosti)
    {
        $this->ispunjenUCelosti = $ispunjenUCelosti;
    }

    /**
     * @return mixed
     */
    public function getIspunjenNaJezikuZavrsnogIzvestaja()
    {
        return $this->ispunjenNaJezikuZavrsnogIzvestaja;
    }

    /**
     * @param mixed $ispunjenNaJezikuZavrsnogIzvestaja
     */
    public function setIspunjenNaJezikuZavrsnogIzvestaja($ispunjenNaJezikuZavrsnogIzvestaja)
    {
        $this->ispunjenNaJezikuZavrsnogIzvestaja = $ispunjenNaJezikuZavrsnogIzvestaja;
    }

    /**
     * @return mixed
     */
    public function getPrilozenaIzjava()
    {
        return $this->prilozenaIzjava;
    }

    /**
     * @param mixed $prilozenaIzjava
     */
    public function setPrilozenaIzjava($prilozenaIzjava)
    {
        $this->prilozenaIzjava = $prilozenaIzjava;
    }

    /**
     * @return mixed
     */
    public function getRasporedAktivnosti()
    {
        return $this->rasporedAktivnosti;
    }

    /**
     * @param mixed $rasporedAktivnosti
     */
    public function setRasporedAktivnosti($rasporedAktivnosti)
    {
        $this->rasporedAktivnosti = $rasporedAktivnosti;
    }

    /**
     * @return mixed
     */
    public function getIzvestajJeFormalno()
    {
        return $this->izvestajJeFormalno;
    }

    /**
     * @param mixed $izvestajJeFormalno
     */
    public function setIzvestajJeFormalno($izvestajJeFormalno)
    {
        $this->izvestajJeFormalno = $izvestajJeFormalno;
    }

}