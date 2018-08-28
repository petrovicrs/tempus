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
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProjectReportingProveraDokumentacijeRepository")
 * @ORM\Table(name="project_reporting_provera_dokumentacije")
 */
class ProjectReportingProveraDokumentacije extends AbstractAuditable
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
     * @ORM\OneToMany(targetEntity="Reporting", mappedBy="projectReportingProveraDokumentacije", cascade={"persist"})
     */
    protected $reporting;

    /**
     * @ORM\Column(name="ulazak_izvestaja", type="date", nullable=true)
     */
    protected $ulazakIzvestaja;

    /**
     * @var  $potpunaFinansijskaDokumentacija
     * @Assert\Type("string")
     * @ORM\Column(name="potpuna_finansijska_dokumentacija", type="string", length=255, nullable=true)
     */
    protected $potpunaFinansijskaDokumentacija;

    /**
     * @var  $potpunaDodatnaDokumentacija
     * @Assert\Type("string")
     * @ORM\Column(name="potpuna_dodatna_dokumentacija", type="string", length=255, nullable=true)
     */
    protected $potpunaDodatnaDokumentacija;

    /**
     * @var  $razlogNepotpuneDokumentacije
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
     * @ORM\ManyToOne(
     *      targetEntity="User"
     * )
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    protected $proveruIzvrsio;

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
    protected $pregledao;

    /**
     * @var  $apsorbovatiAlociranBudzet
     * @Assert\Type("string")
     * @ORM\Column(name="apsorbovati_alociran_budzet", type="string", length=255, nullable=true)
     */
    protected $apsorbovatiAlociranBudzet;

    /**
     * @ORM\Column(name="datum_zavrsetka_obrade", type="date", nullable=true)
     */
    protected $datumZavrsetkaObrade;

    /**
     * @var  $pitanje1pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_1_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje1pp1;

    /**
     * @var  $pitanje2pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_2_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje2pp1;

    /**
     * @var  $pitanje3pp1pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_3_pp_1_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje3pp1pp1;

    /**
     * @var  $pitanje4pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_4_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje4pp1;

    /**
     * @var  $pitanje5pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_5_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje5pp1;

    /**
     * @var  $pitanje6pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_6_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje6pp1;

    /**
     * @var  $pitanje7pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje7pp1;

    /**
     * @var  $pitanje7pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7_pp_2", type="string", length=255, nullable=true)
     */
    protected $pitanje7pp2;

    /**
     * @var  $pitanje7pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_7_pp_3", type="string", length=255, nullable=true)
     */
    protected $pitanje7pp3;

    /**
     * @var  $pitanje8pp1
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_1", type="string", length=255, nullable=true)
     */
    protected $pitanje8pp1;

    /**
     * @var  $pitanje8pp2
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_2", type="string", length=255, nullable=true)
     */
    protected $pitanje8pp2;

    /**
     * @var  $pitanje8pp3
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_3", type="string", length=255, nullable=true)
     */
    protected $pitanje8pp3;

    /**
     * @var  $pitanje8pp4
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_4", type="string", length=255, nullable=true)
     */
    protected $pitanje8pp4;

    /**
     * @var  $pitanje8pp5
     * @Assert\Type("string")
     * @ORM\Column(name="pitanje_8_pp_5", type="string", length=255, nullable=true)
     */
    protected $pitanje8pp5;

    /**
     * @var  $rokZaObraduIzvestaja
     * @Assert\Type("string")
     * @ORM\Column(name="rok_obradu_izvestaja", type="string", length=255, nullable=true)
     */
    protected $rokZaObraduIzvestaja;

    /**
     * @var  $odobreniTroskoviPuta
     * @Assert\Type("string")
     * @ORM\Column(name="odobreni_troskovi_puta", type="string", length=20, nullable=true)
     */
    protected $odobreniTroskoviPuta;

    /**
     * @var  $odobrenaIndividualnaPodrska
     * @Assert\Type("string")
     * @ORM\Column(name="odobrena_individualna_podrska", type="string", length=20, nullable=true)
     */
    protected $odobrenaIndividualnaPodrska;

    /**
     * @var  $odobrenaOrganizacionaPodrska
     * @Assert\Type("string")
     * @ORM\Column(name="odobrena_organizaciona_podrska", type="string", length=20, nullable=true)
     */
    protected $odobrenaOrganizacionaPodrska;

    /**
     * @var  $odobrenaPodrskaLicaSaInvaliditetom
     * @Assert\Type("string")
     * @ORM\Column(name="odobrena_podrska_lica_invaliditetom", type="string", length=20, nullable=true)
     */
    protected $odobrenaPodrskaLicaSaInvaliditetom;

    /**
     * @var  $odobreniVanredniTroskovi
     * @Assert\Type("string")
     * @ORM\Column(name="odobreni_vanredni_troskovi", type="string", length=20, nullable=true)
     */
    protected $odobreniVanredniTroskovi;

    /**
     * @var  $odobreniTroskoviKursa
     * @Assert\Type("string")
     * @ORM\Column(name="odobreni_troskovi_kursa", type="string", length=20, nullable=true)
     */
    protected $odobreniTroskoviKursa;

    /**
     * @var  $stanjeTroskovaPutaNakonRealokacija
     * @Assert\Type("string")
     * @ORM\Column(name="stanje_troskova_puta_nakon_realokacija", type="string", length=20, nullable=true)
     */
    protected $stanjeTroskovaPutaNakonRealokacija;

    /**
     * @var  $stanjeIndividualnaPodrskaNakonRealokacija
     * @Assert\Type("string")
     * @ORM\Column(name="stanje_individualna_podrska_nakon_realokacija", type="string", length=20, nullable=true)
     */
    protected $stanjeIndividualnaPodrskaNakonRealokacija;

    /**
     * @var  $stanjeOrganizacionaPodrskeNakonRealokacija
     * @Assert\Type("string")
     * @ORM\Column(name="stanje_organizaciona_podrske_nakon_realokacija", type="string", length=20, nullable=true)
     */
    protected $stanjeOrganizacionaPodrskeNakonRealokacija;

    /**
     * @var  $stanjePodrskeLicaSaInvaliditetomNakonRealokacija
     * @Assert\Type("string")
     * @ORM\Column(name="stanje_podrske_lica_invaliditetom_nakon_realokacija", type="string", length=20, nullable=true)
     */
    protected $stanjePodrskeLicaSaInvaliditetomNakonRealokacija;

    /**
     * @var  $stanjeOdobrenihVanrednihTroskovaNakonRealokacija
     * @Assert\Type("string")
     * @ORM\Column(name="stanje_odobrenih_vanrednih_troskova_nakon_realokacija", type="string", length=20, nullable=true)
     */
    protected $stanjeOdobrenihVanrednihTroskovaNakonRealokacija;

    /**
     * @var  $stanjeTroskovaKursaNakonRealokacija
     * @Assert\Type("string")
     * @ORM\Column(name="stanje_troskova_kursa_nakon_realokacija", type="string", length=20, nullable=true)
     */
    protected $stanjeTroskovaKursaNakonRealokacija;

    /**
     * @var  $zavrsniIzvestajTackaPrva
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsni_izvestaj_tacka_prva", type="string", length=20, nullable=true)
     */
    protected $zavrsniIzvestajTackaPrva;

    /**
     * @var  $zavrsniIzvestajTackaDruga
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsni_izvestaj_tacka_druga", type="string", length=20, nullable=true)
     */
    protected $zavrsniIzvestajTackaDruga;

    /**
     * @var  $zavrsniIzvestajTackaTreca
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsni_izvestaj_tacka_treca", type="string", length=20, nullable=true)
     */
    protected $zavrsniIzvestajTackaTreca;

    /**
     * @var  $zavrsniIzvestajTackaCetvrta
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsni_izvestaj_tacka_cetvrta", type="string", length=20, nullable=true)
     */
    protected $zavrsniIzvestajTackaCetvrta;

    /**
     * @var  $zavrsniIzvestajTackaPeta
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsni_izvestaj_tacka_peta", type="string", length=20, nullable=true)
     */
    protected $zavrsniIzvestajTackaPeta;

    /**
     * @var  $zavrsniIzvestajTackaSesta
     * @Assert\Type("string")
     * @ORM\Column(name="zavrsni_izvestaj_tacka_sesta", type="string", length=20, nullable=true)
     */
    protected $zavrsniIzvestajTackaSesta;

    /**
     * @var  $brojOdobrenihDanaUcenikaTackaPrva
     * @Assert\Type("string")
     * @ORM\Column(name="broj_odobrenih_dana_ucenika_tacka_prva", type="string", length=20, nullable=true)
     */
    protected $brojOdobrenihDanaUcenikaTackaPrva;

    /**
     * @var  $brojOdobrenihDanaUcenikaTackaDruga
     * @Assert\Type("string")
     * @ORM\Column(name="broj_odobrenih_dana_ucenika_tacka_druga", type="string", length=20, nullable=true)
     */
    protected $brojOdobrenihDanaUcenikaTackaDruga;

    /**
     * @var  $brojOdobrenihDanaUcenikaTackaTreca
     * @Assert\Type("string")
     * @ORM\Column(name="broj_odobrenih_dana_ucenika_tacka_treca", type="string", length=20, nullable=true)
     */
    protected $brojOdobrenihDanaUcenikaTackaTreca;

    /**
     * @var  $brojOdobrenihDanaUcenikaTackaCetvrta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_odobrenih_dana_ucenika_tacka_cetvrta", type="string", length=20, nullable=true)
     */
    protected $brojOdobrenihDanaUcenikaTackaCetvrta;

    /**
     * @var  $brojOdobrenihDanaUcenikaTackaPeta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_odobrenih_dana_ucenika_tacka_peta", type="string", length=20, nullable=true)
     */
    protected $brojOdobrenihDanaUcenikaTackaPeta;

    /**
     * @var  $brojOdobrenihDanaUcenikaTackaSesta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_odobrenih_dana_ucenika_tacka_sesta", type="string", length=20, nullable=true)
     */
    protected $brojOdobrenihDanaUcenikaTackaSesta;

    /**
     * @var  $brojZatrazenihDanaUcenikaTackaPrva
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_tacka_prva", type="string", length=20, nullable=true)
     */
    protected $brojZatrazenihDanaUcenikaTackaPrva;

    /**
     * @var  $brojZatrazenihDanaUcenikaTackaDruga
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_tacka_druga", type="string", length=20, nullable=true)
     */
    protected $brojZatrazenihDanaUcenikaTackaDruga;

    /**
     * @var  $brojZatrazenihDanaUcenikaTackaTreca
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_tacka_treca", type="string", length=20, nullable=true)
     */
    protected $brojZatrazenihDanaUcenikaTackaTreca;

    /**
     * @var  $brojZatrazenihDanaUcenikaTackaCetvrta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_tacka_cetvrta", type="string", length=20, nullable=true)
     */
    protected $brojZatrazenihDanaUcenikaTackaCetvrta;

    /**
     * @var  $brojZatrazenihDanaUcenikaTackaPeta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_tacka_peta", type="string", length=20, nullable=true)
     */
    protected $brojZatrazenihDanaUcenikaTackaPeta;

    /**
     * @var  $brojZatrazenihDanaUcenikaTackaSesta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_tacka_sesta", type="string", length=20, nullable=true)
     */
    protected $brojZatrazenihDanaUcenikaTackaSesta;

    /**
     * @var  $brojDanaUcenikaNakonZavrsnogTackaPrva
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_nakon_zavrsnog_tacka_prva", type="string", length=20, nullable=true)
     */
    protected $brojDanaUcenikaNakonZavrsnogTackaPrva;

    /**
     * @var  $brojDanaUcenikaNakonZavrsnogTackaDruga
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_nakon_zavrsnog_tacka_druga", type="string", length=20, nullable=true)
     */
    protected $brojDanaUcenikaNakonZavrsnogTackaDruga;

    /**
     * @var  $brojDanaUcenikaNakonZavrsnogTackaTreca
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_nakon_zavrsnog_tacka_treca", type="string", length=20, nullable=true)
     */
    protected $brojDanaUcenikaNakonZavrsnogTackaTreca;

    /**
     * @var  $brojDanaUcenikaNakonZavrsnogTackaCetvrta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_nakon_zavrsnog_tacka_cetvrta", type="string", length=20, nullable=true)
     */
    protected $brojDanaUcenikaNakonZavrsnogTackaCetvrta;

    /**
     * @var  $brojDanaUcenikaNakonZavrsnogTackaPeta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_nakon_zavrsnog_tacka_peta", type="string", length=20, nullable=true)
     */
    protected $brojDanaUcenikaNakonZavrsnogTackaPeta;

    /**
     * @var  $brojDanaUcenikaNakonZavrsnogTackaSesta
     * @Assert\Type("string")
     * @ORM\Column(name="broj_zatrazenih_dana_ucenika_nakon_zavrsnog_tacka_sesta", type="string", length=20, nullable=true)
     */
    protected $brojDanaUcenikaNakonZavrsnogTackaSesta;

    /**
     * @var  $odobrenoNakonZavrsnogTackaPrva
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_nakon_zavrsnog_tacka_prva", type="string", length=20, nullable=true)
     */
    protected $odobrenoNakonZavrsnogTackaPrva;

    /**
     * @var  $odobrenoNakonZavrsnogTackaDruga
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_nakon_zavrsnog_tacka_druga", type="string", length=20, nullable=true)
     */
    protected $odobrenoNakonZavrsnogTackaDruga;

    /**
     * @var  $odobrenoNakonZavrsnogTackaTreca
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_nakon_zavrsnog_tacka_treca", type="string", length=20, nullable=true)
     */
    protected $odobrenoNakonZavrsnogTackaTreca;

    /**
     * @var  $odobrenoNakonZavrsnogTackaCetvrta
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_nakon_zavrsnog_tacka_cetvrta", type="string", length=20, nullable=true)
     */
    protected $odobrenoNakonZavrsnogTackaCetvrta;

    /**
     * @var  $odobrenoNakonZavrsnogTackaPeta
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_nakon_zavrsnog_tacka_peta", type="string", length=20, nullable=true)
     */
    protected $odobrenoNakonZavrsnogTackaPeta;

    /**
     * @var  $odobrenoNakonZavrsnogTackaSesta
     * @Assert\Type("string")
     * @ORM\Column(name="odobreno_nakon_zavrsnog_tacka_sesta", type="string", length=20, nullable=true)
     */
    protected $odobrenoNakonZavrsnogTackaSesta;

    /**
     * @var  $finansijskaKorekcijaTackaPrva
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija_tacka_prva", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcijaTackaPrva;

    /**
     * @var  $finansijskaKorekcijaTackaDruga
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija_tacka_druga", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcijaTackaDruga;

    /**
     * @var  $finansijskaKorekcijaTackaTreca
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija_tacka_treca", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcijaTackaTreca;

    /**
     * @var  $finansijskaKorekcijaTackaCetvrta
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija_tacka_cetvrta", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcijaTackaCetvrta;

    /**
     * @var  $finansijskaKorekcijaTackaPeta
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija_tacka_peta", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcijaTackaPeta;

    /**
     * @var  $finansijskaKorekcijaTackaSesta
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija_tacka_sesta", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcijaTackaSesta;

    /**
     * @var  $ukupnoUplacenoDoSada
     * @Assert\Type("string")
     * @ORM\Column(name="ukupno_uplaceno_do_sada", type="string", length=20, nullable=true)
     */
    protected $ukupnoUplacenoDoSada;

    /**
     * @var  $preostaloZaZavrsnuIsplatu
     * @Assert\Type("string")
     * @ORM\Column(name="preostalo_za_zavrsnu_isplatu", type="string", length=20, nullable=true)
     */
    protected $preostaloZaZavrsnuIsplatu;

    /**
     * @var  $preostaloZaPovrat
     * @Assert\Type("string")
     * @ORM\Column(name="preostalo_za_povrat", type="string", length=20, nullable=true)
     */
    protected $preostaloZaPovrat;

    /**
     * @var  $finansijskaKorekcija
     * @Assert\Type("string")
     * @ORM\Column(name="finansijska_korekcija", type="string", length=20, nullable=true)
     */
    protected $finansijskaKorekcija;

    /**
     * @var  $komentarDoradeFinansijskogIzvestaja
     * @Assert\Type("string")
     * @ORM\Column(name="komentar_dorade_finansijskog_izvestaja", type="text", nullable=true)
     */
    protected $komentarDoradeFinansijskogIzvestaja;

    /**
     * @var  $smanjenjeGrantaLosKvalitet
     * @Assert\Type("string")
     * @ORM\Column(name="smanjenje_granta_los_kvalitet", type="text", nullable=true)
     */
    protected $smanjenjeGrantaLosKvalitet;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
     * @param mixed $reporting
     */
    public function setReporting($reporting)
    {
        $this->reporting = $reporting;
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
    public function getPotpunaFinansijskaDokumentacija() 
    {
        return $this->potpunaFinansijskaDokumentacija;
    }

    /**
     * @param  $potpunaFinansijskaDokumentacija
     */
    public function setPotpunaFinansijskaDokumentacija($potpunaFinansijskaDokumentacija)
    {
        $this->potpunaFinansijskaDokumentacija = $potpunaFinansijskaDokumentacija;
    }

    /**
     * @return mixed
     */
    public function getPotpunaDodatnaDokumentacija() 
    {
        return $this->potpunaDodatnaDokumentacija;
    }

    /**
     * @param  $potpunaDodatnaDokumentacija
     */
    public function setPotpunaDodatnaDokumentacija($potpunaDodatnaDokumentacija)
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
     * @param  $razlogNepotpuneDokumentacije
     */
    public function setRazlogNepotpuneDokumentacije($razlogNepotpuneDokumentacije)
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
    public function getProveruIzvrsio()
    {
        return $this->proveruIzvrsio;
    }

    /**
     * @param mixed $proveruIzvrsio
     */
    public function setProveruIzvrsio($proveruIzvrsio)
    {
        $this->proveruIzvrsio = $proveruIzvrsio;
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
    public function getPregledao()
    {
        return $this->pregledao;
    }

    /**
     * @param mixed $pregledao
     */
    public function setPregledao($pregledao)
    {
        $this->pregledao = $pregledao;
    }

    /**
     * @return mixed
     */
    public function getApsorbovatiAlociranBudzet() 
    {
        return $this->apsorbovatiAlociranBudzet;
    }

    /**
     * @param  $apsorbovatiAlociranBudzet
     */
    public function setApsorbovatiAlociranBudzet($apsorbovatiAlociranBudzet)
    {
        $this->apsorbovatiAlociranBudzet = $apsorbovatiAlociranBudzet;
    }

    /**
     * @return mixed
     */
    public function getPitanje1pp1() 
    {
        return $this->pitanje1pp1;
    }

    /**
     * @param  $pitanje1pp1
     */
    public function setPitanje1pp1($pitanje1pp1)
    {
        $this->pitanje1pp1 = $pitanje1pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje2pp1() 
    {
        return $this->pitanje2pp1;
    }

    /**
     * @param  $pitanje2pp1
     */
    public function setPitanje2pp1($pitanje2pp1)
    {
        $this->pitanje2pp1 = $pitanje2pp1;
    }

    /**
     * @return mixed
     */
    public function getPitanje3pp1pp1() 
    {
        return $this->pitanje3pp1pp1;
    }

    /**
     * @param  $pitanje3pp1pp1
     */
    public function setPitanje3pp1pp1($pitanje3pp1pp1)
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
     * @param  $pitanje4pp1
     */
    public function setPitanje4pp1($pitanje4pp1)
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
     * @param  $pitanje5pp1
     */
    public function setPitanje5pp1($pitanje5pp1)
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
     * @param  $pitanje6pp1
     */
    public function setPitanje6pp1($pitanje6pp1)
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
     * @param  $pitanje7pp1
     */
    public function setPitanje7pp1($pitanje7pp1)
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
     * @param  $pitanje7pp2
     */
    public function setPitanje7pp2($pitanje7pp2)
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
     * @param  $pitanje7pp3
     */
    public function setPitanje7pp3($pitanje7pp3)
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
     * @param  $pitanje8pp1
     */
    public function setPitanje8pp1($pitanje8pp1)
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
     * @param  $pitanje8pp2
     */
    public function setPitanje8pp2($pitanje8pp2)
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
     * @param  $pitanje8pp3
     */
    public function setPitanje8pp3($pitanje8pp3)
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
     * @param  $pitanje8pp4
     */
    public function setPitanje8pp4($pitanje8pp4)
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
     * @param  $pitanje8pp5
     */
    public function setPitanje8pp5($pitanje8pp5)
    {
        $this->pitanje8pp5 = $pitanje8pp5;
    }

    /**
     * @return mixed
     */
    public function getRokZaObraduIzvestaja() 
    {
        return $this->rokZaObraduIzvestaja;
    }

    /**
     * @param  $rokZaObraduIzvestaja
     */
    public function setRokZaObraduIzvestaja($rokZaObraduIzvestaja)
    {
        $this->rokZaObraduIzvestaja = $rokZaObraduIzvestaja;
    }

    /**
     * @return mixed
     */
    public function getOdobreniTroskoviPuta() 
    {
        return $this->odobreniTroskoviPuta;
    }

    /**
     * @param  $odobreniTroskoviPuta
     */
    public function setOdobreniTroskoviPuta($odobreniTroskoviPuta)
    {
        $this->odobreniTroskoviPuta = $odobreniTroskoviPuta;
    }

    /**
     * @return mixed
     */
    public function getOdobrenaIndividualnaPodrska() 
    {
        return $this->odobrenaIndividualnaPodrska;
    }

    /**
     * @param  $odobrenaIndividualnaPodrska
     */
    public function setOdobrenaIndividualnaPodrska($odobrenaIndividualnaPodrska)
    {
        $this->odobrenaIndividualnaPodrska = $odobrenaIndividualnaPodrska;
    }

    /**
     * @return mixed
     */
    public function getOdobrenaOrganizacionaPodrska() 
    {
        return $this->odobrenaOrganizacionaPodrska;
    }

    /**
     * @param  $odobrenaOrganizacionaPodrska
     */
    public function setOdobrenaOrganizacionaPodrska($odobrenaOrganizacionaPodrska)
    {
        $this->odobrenaOrganizacionaPodrska = $odobrenaOrganizacionaPodrska;
    }

    /**
     * @return mixed
     */
    public function getOdobrenaPodrskaLicaSaInvaliditetom() 
    {
        return $this->odobrenaPodrskaLicaSaInvaliditetom;
    }

    /**
     * @param  $odobrenaPodrskaLicaSaInvaliditetom
     */
    public function setOdobrenaPodrskaLicaSaInvaliditetom($odobrenaPodrskaLicaSaInvaliditetom)
    {
        $this->odobrenaPodrskaLicaSaInvaliditetom = $odobrenaPodrskaLicaSaInvaliditetom;
    }

    /**
     * @return mixed
     */
    public function getOdobreniVanredniTroskovi() 
    {
        return $this->odobreniVanredniTroskovi;
    }

    /**
     * @param  $odobreniVanredniTroskovi
     */
    public function setOdobreniVanredniTroskovi($odobreniVanredniTroskovi)
    {
        $this->odobreniVanredniTroskovi = $odobreniVanredniTroskovi;
    }

    /**
     * @return mixed
     */
    public function getOdobreniTroskoviKursa() 
    {
        return $this->odobreniTroskoviKursa;
    }

    /**
     * @param  $odobreniTroskoviKursa
     */
    public function setOdobreniTroskoviKursa($odobreniTroskoviKursa)
    {
        $this->odobreniTroskoviKursa = $odobreniTroskoviKursa;
    }

    /**
     * @return mixed
     */
    public function getStanjeTroskovaPutaNakonRealokacija() 
    {
        return $this->stanjeTroskovaPutaNakonRealokacija;
    }

    /**
     * @param  $stanjeTroskovaPutaNakonRealokacija
     */
    public function setStanjeTroskovaPutaNakonRealokacija($stanjeTroskovaPutaNakonRealokacija)
    {
        $this->stanjeTroskovaPutaNakonRealokacija = $stanjeTroskovaPutaNakonRealokacija;
    }

    /**
     * @return mixed
     */
    public function getStanjeIndividualnaPodrskaNakonRealokacija() 
    {
        return $this->stanjeIndividualnaPodrskaNakonRealokacija;
    }

    /**
     * @param  $stanjeIndividualnaPodrskaNakonRealokacija
     */
    public function setStanjeIndividualnaPodrskaNakonRealokacija($stanjeIndividualnaPodrskaNakonRealokacija)
    {
        $this->stanjeIndividualnaPodrskaNakonRealokacija = $stanjeIndividualnaPodrskaNakonRealokacija;
    }

    /**
     * @return mixed
     */
    public function getStanjeOrganizacionaPodrskeNakonRealokacija() 
    {
        return $this->stanjeOrganizacionaPodrskeNakonRealokacija;
    }

    /**
     * @param  $stanjeOrganizacionaPodrskeNakonRealokacija
     */
    public function setStanjeOrganizacionaPodrskeNakonRealokacija($stanjeOrganizacionaPodrskeNakonRealokacija)
    {
        $this->stanjeOrganizacionaPodrskeNakonRealokacija = $stanjeOrganizacionaPodrskeNakonRealokacija;
    }

    /**
     * @return mixed
     */
    public function getStanjePodrskeLicaSaInvaliditetomNakonRealokacija() 
    {
        return $this->stanjePodrskeLicaSaInvaliditetomNakonRealokacija;
    }

    /**
     * @param  $stanjePodrskeLicaSaInvaliditetomNakonRealokacija
     */
    public function setStanjePodrskeLicaSaInvaliditetomNakonRealokacija($stanjePodrskeLicaSaInvaliditetomNakonRealokacija)
    {
        $this->stanjePodrskeLicaSaInvaliditetomNakonRealokacija = $stanjePodrskeLicaSaInvaliditetomNakonRealokacija;
    }

    /**
     * @return mixed
     */
    public function getStanjeOdobrenihVanrednihTroskovaNakonRealokacija()
    {
        return $this->stanjeOdobrenihVanrednihTroskovaNakonRealokacija;
    }

    /**
     * @param  $stanjeOdobrenihVanrednihTroskovaNakonRealokacija
     */
    public function setStanjeOdobrenihVanrednihTroskovaNakonRealokacija($stanjeOdobrenihVanrednihTroskovaNakonRealokacija)
    {
        $this->stanjeOdobrenihVanrednihTroskovaNakonRealokacija = $stanjeOdobrenihVanrednihTroskovaNakonRealokacija;
    }

    /**
     * @return mixed
     */
    public function getStanjeTroskovaKursaNakonRealokacija() 
    {
        return $this->stanjeTroskovaKursaNakonRealokacija;
    }

    /**
     * @param  $stanjeTroskovaKursaNakonRealokacija
     */
    public function setStanjeTroskovaKursaNakonRealokacija($stanjeTroskovaKursaNakonRealokacija)
    {
        $this->stanjeTroskovaKursaNakonRealokacija = $stanjeTroskovaKursaNakonRealokacija;
    }

    /**
     * @return mixed
     */
    public function getZavrsniIzvestajTackaPrva() 
    {
        return $this->zavrsniIzvestajTackaPrva;
    }

    /**
     * @param  $zavrsniIzvestajTackaPrva
     */
    public function setZavrsniIzvestajTackaPrva($zavrsniIzvestajTackaPrva)
    {
        $this->zavrsniIzvestajTackaPrva = $zavrsniIzvestajTackaPrva;
    }

    /**
     * @return mixed
     */
    public function getZavrsniIzvestajTackaDruga() 
    {
        return $this->zavrsniIzvestajTackaDruga;
    }

    /**
     * @param  $zavrsniIzvestajTackaDruga
     */
    public function setZavrsniIzvestajTackaDruga($zavrsniIzvestajTackaDruga)
    {
        $this->zavrsniIzvestajTackaDruga = $zavrsniIzvestajTackaDruga;
    }

    /**
     * @return mixed
     */
    public function getZavrsniIzvestajTackaTreca() 
    {
        return $this->zavrsniIzvestajTackaTreca;
    }

    /**
     * @param  $zavrsniIzvestajTackaTreca
     */
    public function setZavrsniIzvestajTackaTreca($zavrsniIzvestajTackaTreca)
    {
        $this->zavrsniIzvestajTackaTreca = $zavrsniIzvestajTackaTreca;
    }

    /**
     * @return mixed
     */
    public function getZavrsniIzvestajTackaCetvrta() 
    {
        return $this->zavrsniIzvestajTackaCetvrta;
    }

    /**
     * @param  $zavrsniIzvestajTackaCetvrta
     */
    public function setZavrsniIzvestajTackaCetvrta($zavrsniIzvestajTackaCetvrta)
    {
        $this->zavrsniIzvestajTackaCetvrta = $zavrsniIzvestajTackaCetvrta;
    }

    /**
     * @return mixed
     */
    public function getZavrsniIzvestajTackaPeta() 
    {
        return $this->zavrsniIzvestajTackaPeta;
    }

    /**
     * @param  $zavrsniIzvestajTackaPeta
     */
    public function setZavrsniIzvestajTackaPeta($zavrsniIzvestajTackaPeta)
    {
        $this->zavrsniIzvestajTackaPeta = $zavrsniIzvestajTackaPeta;
    }

    /**
     * @return mixed
     */
    public function getZavrsniIzvestajTackaSesta() 
    {
        return $this->zavrsniIzvestajTackaSesta;
    }

    /**
     * @param  $zavrsniIzvestajTackaSesta
     */
    public function setZavrsniIzvestajTackaSesta($zavrsniIzvestajTackaSesta)
    {
        $this->zavrsniIzvestajTackaSesta = $zavrsniIzvestajTackaSesta;
    }

    /**
     * @return mixed
     */
    public function getBrojOdobrenihDanaUcenikaTackaPrva() 
    {
        return $this->brojOdobrenihDanaUcenikaTackaPrva;
    }

    /**
     * @param  $brojOdobrenihDanaUcenikaTackaPrva
     */
    public function setBrojOdobrenihDanaUcenikaTackaPrva($brojOdobrenihDanaUcenikaTackaPrva)
    {
        $this->brojOdobrenihDanaUcenikaTackaPrva = $brojOdobrenihDanaUcenikaTackaPrva;
    }

    /**
     * @return mixed
     */
    public function getBrojOdobrenihDanaUcenikaTackaDruga() 
    {
        return $this->brojOdobrenihDanaUcenikaTackaDruga;
    }

    /**
     * @param  $brojOdobrenihDanaUcenikaTackaDruga
     */
    public function setBrojOdobrenihDanaUcenikaTackaDruga($brojOdobrenihDanaUcenikaTackaDruga)
    {
        $this->brojOdobrenihDanaUcenikaTackaDruga = $brojOdobrenihDanaUcenikaTackaDruga;
    }

    /**
     * @return mixed
     */
    public function getBrojOdobrenihDanaUcenikaTackaTreca() 
    {
        return $this->brojOdobrenihDanaUcenikaTackaTreca;
    }

    /**
     * @param  $brojOdobrenihDanaUcenikaTackaTreca
     */
    public function setBrojOdobrenihDanaUcenikaTackaTreca($brojOdobrenihDanaUcenikaTackaTreca)
    {
        $this->brojOdobrenihDanaUcenikaTackaTreca = $brojOdobrenihDanaUcenikaTackaTreca;
    }

    /**
     * @return mixed
     */
    public function getBrojOdobrenihDanaUcenikaTackaCetvrta() 
    {
        return $this->brojOdobrenihDanaUcenikaTackaCetvrta;
    }

    /**
     * @param  $brojOdobrenihDanaUcenikaTackaCetvrta
     */
    public function setBrojOdobrenihDanaUcenikaTackaCetvrta($brojOdobrenihDanaUcenikaTackaCetvrta)
    {
        $this->brojOdobrenihDanaUcenikaTackaCetvrta = $brojOdobrenihDanaUcenikaTackaCetvrta;
    }

    /**
     * @return mixed
     */
    public function getBrojOdobrenihDanaUcenikaTackaPeta() 
    {
        return $this->brojOdobrenihDanaUcenikaTackaPeta;
    }

    /**
     * @param  $brojOdobrenihDanaUcenikaTackaPeta
     */
    public function setBrojOdobrenihDanaUcenikaTackaPeta($brojOdobrenihDanaUcenikaTackaPeta)
    {
        $this->brojOdobrenihDanaUcenikaTackaPeta = $brojOdobrenihDanaUcenikaTackaPeta;
    }

    /**
     * @return mixed
     */
    public function getBrojOdobrenihDanaUcenikaTackaSesta() 
    {
        return $this->brojOdobrenihDanaUcenikaTackaSesta;
    }

    /**
     * @param  $brojOdobrenihDanaUcenikaTackaSesta
     */
    public function setBrojOdobrenihDanaUcenikaTackaSesta($brojOdobrenihDanaUcenikaTackaSesta)
    {
        $this->brojOdobrenihDanaUcenikaTackaSesta = $brojOdobrenihDanaUcenikaTackaSesta;
    }

    /**
     * @return mixed
     */
    public function getBrojZatrazenihDanaUcenikaTackaPrva() 
    {
        return $this->brojZatrazenihDanaUcenikaTackaPrva;
    }

    /**
     * @param  $brojZatrazenihDanaUcenikaTackaPrva
     */
    public function setBrojZatrazenihDanaUcenikaTackaPrva($brojZatrazenihDanaUcenikaTackaPrva)
    {
        $this->brojZatrazenihDanaUcenikaTackaPrva = $brojZatrazenihDanaUcenikaTackaPrva;
    }

    /**
     * @return mixed
     */
    public function getBrojZatrazenihDanaUcenikaTackaDruga() 
    {
        return $this->brojZatrazenihDanaUcenikaTackaDruga;
    }

    /**
     * @param  $brojZatrazenihDanaUcenikaTackaDruga
     */
    public function setBrojZatrazenihDanaUcenikaTackaDruga($brojZatrazenihDanaUcenikaTackaDruga)
    {
        $this->brojZatrazenihDanaUcenikaTackaDruga = $brojZatrazenihDanaUcenikaTackaDruga;
    }

    /**
     * @return mixed
     */
    public function getBrojZatrazenihDanaUcenikaTackaTreca() 
    {
        return $this->brojZatrazenihDanaUcenikaTackaTreca;
    }

    /**
     * @param  $brojZatrazenihDanaUcenikaTackaTreca
     */
    public function setBrojZatrazenihDanaUcenikaTackaTreca($brojZatrazenihDanaUcenikaTackaTreca)
    {
        $this->brojZatrazenihDanaUcenikaTackaTreca = $brojZatrazenihDanaUcenikaTackaTreca;
    }

    /**
     * @return mixed
     */
    public function getBrojZatrazenihDanaUcenikaTackaCetvrta() 
    {
        return $this->brojZatrazenihDanaUcenikaTackaCetvrta;
    }

    /**
     * @param  $brojZatrazenihDanaUcenikaTackaCetvrta
     */
    public function setBrojZatrazenihDanaUcenikaTackaCetvrta($brojZatrazenihDanaUcenikaTackaCetvrta)
    {
        $this->brojZatrazenihDanaUcenikaTackaCetvrta = $brojZatrazenihDanaUcenikaTackaCetvrta;
    }

    /**
     * @return mixed
     */
    public function getBrojZatrazenihDanaUcenikaTackaPeta() 
    {
        return $this->brojZatrazenihDanaUcenikaTackaPeta;
    }

    /**
     * @param  $brojZatrazenihDanaUcenikaTackaPeta
     */
    public function setBrojZatrazenihDanaUcenikaTackaPeta($brojZatrazenihDanaUcenikaTackaPeta)
    {
        $this->brojZatrazenihDanaUcenikaTackaPeta = $brojZatrazenihDanaUcenikaTackaPeta;
    }

    /**
     * @return mixed
     */
    public function getBrojZatrazenihDanaUcenikaTackaSesta() 
    {
        return $this->brojZatrazenihDanaUcenikaTackaSesta;
    }

    /**
     * @param  $brojZatrazenihDanaUcenikaTackaSesta
     */
    public function setBrojZatrazenihDanaUcenikaTackaSesta($brojZatrazenihDanaUcenikaTackaSesta)
    {
        $this->brojZatrazenihDanaUcenikaTackaSesta = $brojZatrazenihDanaUcenikaTackaSesta;
    }

    /**
     * @return mixed
     */
    public function getBrojDanaUcenikaNakonZavrsnogTackaPrva() 
    {
        return $this->brojDanaUcenikaNakonZavrsnogTackaPrva;
    }

    /**
     * @param  $brojDanaUcenikaNakonZavrsnogTackaPrva
     */
    public function setBrojDanaUcenikaNakonZavrsnogTackaPrva($brojDanaUcenikaNakonZavrsnogTackaPrva)
    {
        $this->brojDanaUcenikaNakonZavrsnogTackaPrva = $brojDanaUcenikaNakonZavrsnogTackaPrva;
    }

    /**
     * @return mixed
     */
    public function getBrojDanaUcenikaNakonZavrsnogTackaDruga() 
    {
        return $this->brojDanaUcenikaNakonZavrsnogTackaDruga;
    }

    /**
     * @param  $brojDanaUcenikaNakonZavrsnogTackaDruga
     */
    public function setBrojDanaUcenikaNakonZavrsnogTackaDruga($brojDanaUcenikaNakonZavrsnogTackaDruga)
    {
        $this->brojDanaUcenikaNakonZavrsnogTackaDruga = $brojDanaUcenikaNakonZavrsnogTackaDruga;
    }

    /**
     * @return mixed
     */
    public function getBrojDanaUcenikaNakonZavrsnogTackaTreca() 
    {
        return $this->brojDanaUcenikaNakonZavrsnogTackaTreca;
    }

    /**
     * @param  $brojDanaUcenikaNakonZavrsnogTackaTreca
     */
    public function setBrojDanaUcenikaNakonZavrsnogTackaTreca($brojDanaUcenikaNakonZavrsnogTackaTreca)
    {
        $this->brojDanaUcenikaNakonZavrsnogTackaTreca = $brojDanaUcenikaNakonZavrsnogTackaTreca;
    }

    /**
     * @return mixed
     */
    public function getBrojDanaUcenikaNakonZavrsnogTackaCetvrta() 
    {
        return $this->brojDanaUcenikaNakonZavrsnogTackaCetvrta;
    }

    /**
     * @param  $brojDanaUcenikaNakonZavrsnogTackaCetvrta
     */
    public function setBrojDanaUcenikaNakonZavrsnogTackaCetvrta($brojDanaUcenikaNakonZavrsnogTackaCetvrta)
    {
        $this->brojDanaUcenikaNakonZavrsnogTackaCetvrta = $brojDanaUcenikaNakonZavrsnogTackaCetvrta;
    }

    /**
     * @return mixed
     */
    public function getBrojDanaUcenikaNakonZavrsnogTackaPeta() 
    {
        return $this->brojDanaUcenikaNakonZavrsnogTackaPeta;
    }

    /**
     * @param  $brojDanaUcenikaNakonZavrsnogTackaPeta
     */
    public function setBrojDanaUcenikaNakonZavrsnogTackaPeta($brojDanaUcenikaNakonZavrsnogTackaPeta)
    {
        $this->brojDanaUcenikaNakonZavrsnogTackaPeta = $brojDanaUcenikaNakonZavrsnogTackaPeta;
    }

    /**
     * @return mixed
     */
    public function getBrojDanaUcenikaNakonZavrsnogTackaSesta() 
    {
        return $this->brojDanaUcenikaNakonZavrsnogTackaSesta;
    }

    /**
     * @param  $brojDanaUcenikaNakonZavrsnogTackaSesta
     */
    public function setBrojDanaUcenikaNakonZavrsnogTackaSesta($brojDanaUcenikaNakonZavrsnogTackaSesta)
    {
        $this->brojDanaUcenikaNakonZavrsnogTackaSesta = $brojDanaUcenikaNakonZavrsnogTackaSesta;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoNakonZavrsnogTackaPrva() 
    {
        return $this->odobrenoNakonZavrsnogTackaPrva;
    }

    /**
     * @param  $odobrenoNakonZavrsnogTackaPrva
     */
    public function setOdobrenoNakonZavrsnogTackaPrva($odobrenoNakonZavrsnogTackaPrva)
    {
        $this->odobrenoNakonZavrsnogTackaPrva = $odobrenoNakonZavrsnogTackaPrva;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoNakonZavrsnogTackaDruga() 
    {
        return $this->odobrenoNakonZavrsnogTackaDruga;
    }

    /**
     * @param  $odobrenoNakonZavrsnogTackaDruga
     */
    public function setOdobrenoNakonZavrsnogTackaDruga($odobrenoNakonZavrsnogTackaDruga)
    {
        $this->odobrenoNakonZavrsnogTackaDruga = $odobrenoNakonZavrsnogTackaDruga;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoNakonZavrsnogTackaTreca() 
    {
        return $this->odobrenoNakonZavrsnogTackaTreca;
    }

    /**
     * @param  $odobrenoNakonZavrsnogTackaTreca
     */
    public function setOdobrenoNakonZavrsnogTackaTreca($odobrenoNakonZavrsnogTackaTreca)
    {
        $this->odobrenoNakonZavrsnogTackaTreca = $odobrenoNakonZavrsnogTackaTreca;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoNakonZavrsnogTackaCetvrta() 
    {
        return $this->odobrenoNakonZavrsnogTackaCetvrta;
    }

    /**
     * @param  $odobrenoNakonZavrsnogTackaCetvrta
     */
    public function setOdobrenoNakonZavrsnogTackaCetvrta($odobrenoNakonZavrsnogTackaCetvrta)
    {
        $this->odobrenoNakonZavrsnogTackaCetvrta = $odobrenoNakonZavrsnogTackaCetvrta;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoNakonZavrsnogTackaPeta() 
    {
        return $this->odobrenoNakonZavrsnogTackaPeta;
    }

    /**
     * @param  $odobrenoNakonZavrsnogTackaPeta
     */
    public function setOdobrenoNakonZavrsnogTackaPeta($odobrenoNakonZavrsnogTackaPeta)
    {
        $this->odobrenoNakonZavrsnogTackaPeta = $odobrenoNakonZavrsnogTackaPeta;
    }

    /**
     * @return mixed
     */
    public function getOdobrenoNakonZavrsnogTackaSesta() 
    {
        return $this->odobrenoNakonZavrsnogTackaSesta;
    }

    /**
     * @param  $odobrenoNakonZavrsnogTackaSesta
     */
    public function setOdobrenoNakonZavrsnogTackaSesta($odobrenoNakonZavrsnogTackaSesta)
    {
        $this->odobrenoNakonZavrsnogTackaSesta = $odobrenoNakonZavrsnogTackaSesta;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcijaTackaPrva() 
    {
        return $this->finansijskaKorekcijaTackaPrva;
    }

    /**
     * @param  $finansijskaKorekcijaTackaPrva
     */
    public function setFinansijskaKorekcijaTackaPrva($finansijskaKorekcijaTackaPrva)
    {
        $this->finansijskaKorekcijaTackaPrva = $finansijskaKorekcijaTackaPrva;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcijaTackaDruga() 
    {
        return $this->finansijskaKorekcijaTackaDruga;
    }

    /**
     * @param  $finansijskaKorekcijaTackaDruga
     */
    public function setFinansijskaKorekcijaTackaDruga($finansijskaKorekcijaTackaDruga)
    {
        $this->finansijskaKorekcijaTackaDruga = $finansijskaKorekcijaTackaDruga;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcijaTackaTreca() 
    {
        return $this->finansijskaKorekcijaTackaTreca;
    }

    /**
     * @param  $finansijskaKorekcijaTackaTreca
     */
    public function setFinansijskaKorekcijaTackaTreca($finansijskaKorekcijaTackaTreca)
    {
        $this->finansijskaKorekcijaTackaTreca = $finansijskaKorekcijaTackaTreca;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcijaTackaCetvrta() 
    {
        return $this->finansijskaKorekcijaTackaCetvrta;
    }

    /**
     * @param  $finansijskaKorekcijaTackaCetvrta
     */
    public function setFinansijskaKorekcijaTackaCetvrta($finansijskaKorekcijaTackaCetvrta)
    {
        $this->finansijskaKorekcijaTackaCetvrta = $finansijskaKorekcijaTackaCetvrta;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcijaTackaPeta() 
    {
        return $this->finansijskaKorekcijaTackaPeta;
    }

    /**
     * @param  $finansijskaKorekcijaTackaPeta
     */
    public function setFinansijskaKorekcijaTackaPeta($finansijskaKorekcijaTackaPeta)
    {
        $this->finansijskaKorekcijaTackaPeta = $finansijskaKorekcijaTackaPeta;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcijaTackaSesta() 
    {
        return $this->finansijskaKorekcijaTackaSesta;
    }

    /**
     * @param  $finansijskaKorekcijaTackaSesta
     */
    public function setFinansijskaKorekcijaTackaSesta($finansijskaKorekcijaTackaSesta)
    {
        $this->finansijskaKorekcijaTackaSesta = $finansijskaKorekcijaTackaSesta;
    }

    /**
     * @return mixed
     */
    public function getUkupnoUplacenoDoSada() 
    {
        return $this->ukupnoUplacenoDoSada;
    }

    /**
     * @param  $ukupnoUplacenoDoSada
     */
    public function setUkupnoUplacenoDoSada($ukupnoUplacenoDoSada)
    {
        $this->ukupnoUplacenoDoSada = $ukupnoUplacenoDoSada;
    }

    /**
     * @return mixed
     */
    public function getPreostaloZaZavrsnuIsplatu() 
    {
        return $this->preostaloZaZavrsnuIsplatu;
    }

    /**
     * @param  $preostaloZaZavrsnuIsplatu
     */
    public function setPreostaloZaZavrsnuIsplatu($preostaloZaZavrsnuIsplatu)
    {
        $this->preostaloZaZavrsnuIsplatu = $preostaloZaZavrsnuIsplatu;
    }

    /**
     * @return mixed
     */
    public function getPreostaloZaPovrat() 
    {
        return $this->preostaloZaPovrat;
    }

    /**
     * @param  $preostaloZaPovrat
     */
    public function setPreostaloZaPovrat($preostaloZaPovrat)
    {
        $this->preostaloZaPovrat = $preostaloZaPovrat;
    }

    /**
     * @return mixed
     */
    public function getFinansijskaKorekcija() 
    {
        return $this->finansijskaKorekcija;
    }

    /**
     * @param  $finansijskaKorekcija
     */
    public function setFinansijskaKorekcija($finansijskaKorekcija)
    {
        $this->finansijskaKorekcija = $finansijskaKorekcija;
    }

    /**
     * @return mixed
     */
    public function getKomentarDoradeFinansijskogIzvestaja() 
    {
        return $this->komentarDoradeFinansijskogIzvestaja;
    }

    /**
     * @param  $komentarDoradeFinansijskogIzvestaja
     */
    public function setKomentarDoradeFinansijskogIzvestaja($komentarDoradeFinansijskogIzvestaja)
    {
        $this->komentarDoradeFinansijskogIzvestaja = $komentarDoradeFinansijskogIzvestaja;
    }

    /**
     * @return mixed
     */
    public function getSmanjenjeGrantaLosKvalitet() 
    {
        return $this->smanjenjeGrantaLosKvalitet;
    }

    /**
     * @param  $smanjenjeGrantaLosKvalitet
     */
    public function setSmanjenjeGrantaLosKvalitet($smanjenjeGrantaLosKvalitet)
    {
        $this->smanjenjeGrantaLosKvalitet = $smanjenjeGrantaLosKvalitet;
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

}