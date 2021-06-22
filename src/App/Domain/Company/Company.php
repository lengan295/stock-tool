<?php

namespace App\Domain\Company;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company", indexes={@ORM\Index(name="code_industry", columns={"code_industry"})})
 * @ORM\Entity
 */
class Company
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_industry", type="integer", nullable=true)
     */
    private $codeIndustry;

    /**
     * @var int|null
     *
     * @ORM\Column(name="market_cap", type="bigint", nullable=true)
     */
    private $marketCap;

    /**
     * @var int|null
     *
     * @ORM\Column(name="volume_10_session", type="bigint", nullable=true)
     */
    private $volume10Session;

    /**
     * @var string|null
     *
     * @ORM\Column(name="max_52_weeks", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $max52Weeks;

    /**
     * @var string|null
     *
     * @ORM\Column(name="min_52_weeks", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $min52Weeks;

    /**
     * @var int|null
     *
     * @ORM\Column(name="shares", type="bigint", nullable=true)
     */
    private $shares;

    /**
     * @var string|null
     *
     * @ORM\Column(name="free_float", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $freeFloat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="beta", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $beta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pe", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $pe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pb", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $pb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dividend_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $dividendRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bvps", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $bvps;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roae", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $roae;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roaa", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $roaa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="eps", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $eps;

    /**
     * @var string|null
     *
     * @ORM\Column(name="stock_price", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $stockPrice;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="price_update_at", type="datetime", nullable=true)
     */
    private $priceUpdateAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="App\Domain\Company\CompanyHistoricalData", mappedBy="company")
     */
    private $historicalData;

    /**
     * @ORM\OneToOne(targetEntity="App\Domain\Company\CompanyAnalysing4m", mappedBy="company")
     */
    private $analysing4m;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historicalData = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return Company
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Company
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set codeIndustry.
     *
     * @param int|null $codeIndustry
     *
     * @return Company
     */
    public function setCodeIndustry($codeIndustry = null)
    {
        $this->codeIndustry = $codeIndustry;

        return $this;
    }

    /**
     * Get codeIndustry.
     *
     * @return int|null
     */
    public function getCodeIndustry()
    {
        return $this->codeIndustry;
    }

    /**
     * Set marketCap.
     *
     * @param int|null $marketCap
     *
     * @return Company
     */
    public function setMarketCap($marketCap = null)
    {
        $this->marketCap = $marketCap;

        return $this;
    }

    /**
     * Get marketCap.
     *
     * @return int|null
     */
    public function getMarketCap()
    {
        return $this->marketCap;
    }

    /**
     * Set volume10Session.
     *
     * @param int|null $volume10Session
     *
     * @return Company
     */
    public function setVolume10Session($volume10Session = null)
    {
        $this->volume10Session = $volume10Session;

        return $this;
    }

    /**
     * Get volume10Session.
     *
     * @return int|null
     */
    public function getVolume10Session()
    {
        return $this->volume10Session;
    }

    /**
     * Set max52Weeks.
     *
     * @param string|null $max52Weeks
     *
     * @return Company
     */
    public function setMax52Weeks($max52Weeks = null)
    {
        $this->max52Weeks = $max52Weeks;

        return $this;
    }

    /**
     * Get max52Weeks.
     *
     * @return string|null
     */
    public function getMax52Weeks()
    {
        return $this->max52Weeks;
    }

    /**
     * Set min52Weeks.
     *
     * @param string|null $min52Weeks
     *
     * @return Company
     */
    public function setMin52Weeks($min52Weeks = null)
    {
        $this->min52Weeks = $min52Weeks;

        return $this;
    }

    /**
     * Get min52Weeks.
     *
     * @return string|null
     */
    public function getMin52Weeks()
    {
        return $this->min52Weeks;
    }

    /**
     * Set shares.
     *
     * @param int|null $shares
     *
     * @return Company
     */
    public function setShares($shares = null)
    {
        $this->shares = $shares;

        return $this;
    }

    /**
     * Get shares.
     *
     * @return int|null
     */
    public function getShares()
    {
        return $this->shares;
    }

    /**
     * Set freeFloat.
     *
     * @param string|null $freeFloat
     *
     * @return Company
     */
    public function setFreeFloat($freeFloat = null)
    {
        $this->freeFloat = $freeFloat;

        return $this;
    }

    /**
     * Get freeFloat.
     *
     * @return string|null
     */
    public function getFreeFloat()
    {
        return $this->freeFloat;
    }

    /**
     * Set beta.
     *
     * @param string|null $beta
     *
     * @return Company
     */
    public function setBeta($beta = null)
    {
        $this->beta = $beta;

        return $this;
    }

    /**
     * Get beta.
     *
     * @return string|null
     */
    public function getBeta()
    {
        return $this->beta;
    }

    /**
     * Set pe.
     *
     * @param string|null $pe
     *
     * @return Company
     */
    public function setPe($pe = null)
    {
        $this->pe = $pe;

        return $this;
    }

    /**
     * Get pe.
     *
     * @return string|null
     */
    public function getPe()
    {
        return $this->pe;
    }

    /**
     * Set pb.
     *
     * @param string|null $pb
     *
     * @return Company
     */
    public function setPb($pb = null)
    {
        $this->pb = $pb;

        return $this;
    }

    /**
     * Get pb.
     *
     * @return string|null
     */
    public function getPb()
    {
        return $this->pb;
    }

    /**
     * Set dividendRate.
     *
     * @param string|null $dividendRate
     *
     * @return Company
     */
    public function setDividendRate($dividendRate = null)
    {
        $this->dividendRate = $dividendRate;

        return $this;
    }

    /**
     * Get dividendRate.
     *
     * @return string|null
     */
    public function getDividendRate()
    {
        return $this->dividendRate;
    }

    /**
     * Set bvps.
     *
     * @param string|null $bvps
     *
     * @return Company
     */
    public function setBvps($bvps = null)
    {
        $this->bvps = $bvps;

        return $this;
    }

    /**
     * Get bvps.
     *
     * @return string|null
     */
    public function getBvps()
    {
        return $this->bvps;
    }

    /**
     * Set roae.
     *
     * @param string|null $roae
     *
     * @return Company
     */
    public function setRoae($roae = null)
    {
        $this->roae = $roae;

        return $this;
    }

    /**
     * Get roae.
     *
     * @return string|null
     */
    public function getRoae()
    {
        return $this->roae;
    }

    /**
     * Set roaa.
     *
     * @param string|null $roaa
     *
     * @return Company
     */
    public function setRoaa($roaa = null)
    {
        $this->roaa = $roaa;

        return $this;
    }

    /**
     * Get roaa.
     *
     * @return string|null
     */
    public function getRoaa()
    {
        return $this->roaa;
    }

    /**
     * Set eps.
     *
     * @param string|null $eps
     *
     * @return Company
     */
    public function setEps($eps = null)
    {
        $this->eps = $eps;

        return $this;
    }

    /**
     * Get eps.
     *
     * @return string|null
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Add historicalDatum.
     *
     * @param \App\Domain\Company\CompanyHistoricalData $historicalDatum
     *
     * @return Company
     */
    public function addHistoricalDatum(\App\Domain\Company\CompanyHistoricalData $historicalDatum)
    {
        $this->historicalData[] = $historicalDatum;

        return $this;
    }

    /**
     * Remove historicalDatum.
     *
     * @param \App\Domain\Company\CompanyHistoricalData $historicalDatum
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeHistoricalDatum(\App\Domain\Company\CompanyHistoricalData $historicalDatum)
    {
        return $this->historicalData->removeElement($historicalDatum);
    }

    /**
     * Get historicalData.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoricalData()
    {
        return $this->historicalData;
    }

    /**
     * Set analysing4m.
     *
     * @param \App\Domain\Company\CompanyAnalysing4m|null $analysing4m
     *
     * @return Company
     */
    public function setAnalysing4m(\App\Domain\Company\CompanyAnalysing4m $analysing4m = null)
    {
        $this->analysing4m = $analysing4m;

        return $this;
    }

    /**
     * Get analysing4m.
     *
     * @return \App\Domain\Company\CompanyAnalysing4m|null
     */
    public function getAnalysing4m()
    {
        return $this->analysing4m;
    }

    /**
     * Set stockPrice.
     *
     * @param string|null $stockPrice
     *
     * @return Company
     */
    public function setStockPrice($stockPrice = null)
    {
        $this->stockPrice = $stockPrice;

        return $this;
    }

    /**
     * Get stockPrice.
     *
     * @return string|null
     */
    public function getStockPrice()
    {
        return $this->stockPrice;
    }

    /**
     * Set priceUpdateAt.
     *
     * @param \DateTime|null $priceUpdateAt
     *
     * @return Company
     */
    public function setPriceUpdateAt($priceUpdateAt = null)
    {
        $this->priceUpdateAt = $priceUpdateAt;

        return $this;
    }

    /**
     * Get priceUpdateAt.
     *
     * @return \DateTime|null
     */
    public function getPriceUpdateAt()
    {
        return $this->priceUpdateAt;
    }
}
