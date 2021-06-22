<?php

namespace App\Domain\Company;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyAnalysing4m
 *
 * @ORM\Table(name="company_analysing_4m", indexes={@ORM\Index(name="company_analysing_4m_code_fk", columns={"code"})})
 * @ORM\Entity
 */
class CompanyAnalysing4m
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="equity_grow_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $equityGrowRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="net_income_grow_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $netIncomeGrowRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nopat_grow_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $nopatGrowRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="operating_cash_flow_grow_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $operatingCashFlowGrowRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="future_eps_grow_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $futureEpsGrowRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="future_pe", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $futurePe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="minimum_acceptable_rate", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $minimumAcceptableRate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="margin_of_safe", type="decimal", precision=8, scale=4, nullable=true)
     */
    private $marginOfSafe;

    /**
     * @var string|null
     *
     * @ORM\Column(name="future_retail_value", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $futureRetailValue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sticker_price", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $stickerPrice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mos_price", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $mosPrice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graham_price", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $grahamPrice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="graham_mos_price", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $grahamMosPrice;

    /**
     * @var string|null
     *
     * @ORM\Column(name="chosen_price", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $chosenPrice;

    /**
     * @var \App\Domain\Company\Company
     *
     * @ORM\OneToOne(targetEntity="App\Domain\Company\Company", inversedBy="analysing4m")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code", referencedColumnName="code")
     * })
     */
    private $company;



    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set equityGrowRate.
     *
     * @param string|null $equityGrowRate
     *
     * @return CompanyAnalysing4m
     */
    public function setEquityGrowRate($equityGrowRate = null)
    {
        $this->equityGrowRate = $equityGrowRate;

        return $this;
    }

    /**
     * Get equityGrowRate.
     *
     * @return string|null
     */
    public function getEquityGrowRate()
    {
        return $this->equityGrowRate;
    }

    /**
     * Set netIncomeGrowRate.
     *
     * @param string|null $netIncomeGrowRate
     *
     * @return CompanyAnalysing4m
     */
    public function setNetIncomeGrowRate($netIncomeGrowRate = null)
    {
        $this->netIncomeGrowRate = $netIncomeGrowRate;

        return $this;
    }

    /**
     * Get netIncomeGrowRate.
     *
     * @return string|null
     */
    public function getNetIncomeGrowRate()
    {
        return $this->netIncomeGrowRate;
    }

    /**
     * Set nopatGrowRate.
     *
     * @param string|null $nopatGrowRate
     *
     * @return CompanyAnalysing4m
     */
    public function setNopatGrowRate($nopatGrowRate = null)
    {
        $this->nopatGrowRate = $nopatGrowRate;

        return $this;
    }

    /**
     * Get nopatGrowRate.
     *
     * @return string|null
     */
    public function getNopatGrowRate()
    {
        return $this->nopatGrowRate;
    }

    /**
     * Set operatingCashFlowGrowRate.
     *
     * @param string|null $operatingCashFlowGrowRate
     *
     * @return CompanyAnalysing4m
     */
    public function setOperatingCashFlowGrowRate($operatingCashFlowGrowRate = null)
    {
        $this->operatingCashFlowGrowRate = $operatingCashFlowGrowRate;

        return $this;
    }

    /**
     * Get operatingCashFlowGrowRate.
     *
     * @return string|null
     */
    public function getOperatingCashFlowGrowRate()
    {
        return $this->operatingCashFlowGrowRate;
    }

    /**
     * Set futureEpsGrowRate.
     *
     * @param string|null $futureEpsGrowRate
     *
     * @return CompanyAnalysing4m
     */
    public function setFutureEpsGrowRate($futureEpsGrowRate = null)
    {
        $this->futureEpsGrowRate = $futureEpsGrowRate;

        return $this;
    }

    /**
     * Get futureEpsGrowRate.
     *
     * @return string|null
     */
    public function getFutureEpsGrowRate()
    {
        return $this->futureEpsGrowRate;
    }

    /**
     * Set futurePe.
     *
     * @param string|null $futurePe
     *
     * @return CompanyAnalysing4m
     */
    public function setFuturePe($futurePe = null)
    {
        $this->futurePe = $futurePe;

        return $this;
    }

    /**
     * Get futurePe.
     *
     * @return string|null
     */
    public function getFuturePe()
    {
        return $this->futurePe;
    }

    /**
     * Set minimumAcceptableRate.
     *
     * @param string|null $minimumAcceptableRate
     *
     * @return CompanyAnalysing4m
     */
    public function setMinimumAcceptableRate($minimumAcceptableRate = null)
    {
        $this->minimumAcceptableRate = $minimumAcceptableRate;

        return $this;
    }

    /**
     * Get minimumAcceptableRate.
     *
     * @return string|null
     */
    public function getMinimumAcceptableRate()
    {
        return $this->minimumAcceptableRate;
    }

    /**
     * Set marginOfSafe.
     *
     * @param string|null $marginOfSafe
     *
     * @return CompanyAnalysing4m
     */
    public function setMarginOfSafe($marginOfSafe = null)
    {
        $this->marginOfSafe = $marginOfSafe;

        return $this;
    }

    /**
     * Get marginOfSafe.
     *
     * @return string|null
     */
    public function getMarginOfSafe()
    {
        return $this->marginOfSafe;
    }

    /**
     * Set futureRetailValue.
     *
     * @param string|null $futureRetailValue
     *
     * @return CompanyAnalysing4m
     */
    public function setFutureRetailValue($futureRetailValue = null)
    {
        $this->futureRetailValue = $futureRetailValue;

        return $this;
    }

    /**
     * Get futureRetailValue.
     *
     * @return string|null
     */
    public function getFutureRetailValue()
    {
        return $this->futureRetailValue;
    }

    /**
     * Set stickerPrice.
     *
     * @param string|null $stickerPrice
     *
     * @return CompanyAnalysing4m
     */
    public function setStickerPrice($stickerPrice = null)
    {
        $this->stickerPrice = $stickerPrice;

        return $this;
    }

    /**
     * Get stickerPrice.
     *
     * @return string|null
     */
    public function getStickerPrice()
    {
        return $this->stickerPrice;
    }

    /**
     * Set mosPrice.
     *
     * @param string|null $mosPrice
     *
     * @return CompanyAnalysing4m
     */
    public function setMosPrice($mosPrice = null)
    {
        $this->mosPrice = $mosPrice;

        return $this;
    }

    /**
     * Get mosPrice.
     *
     * @return string|null
     */
    public function getMosPrice()
    {
        return $this->mosPrice;
    }

    /**
     * Set grahamPrice.
     *
     * @param string|null $grahamPrice
     *
     * @return CompanyAnalysing4m
     */
    public function setGrahamPrice($grahamPrice = null)
    {
        $this->grahamPrice = $grahamPrice;

        return $this;
    }

    /**
     * Get grahamPrice.
     *
     * @return string|null
     */
    public function getGrahamPrice()
    {
        return $this->grahamPrice;
    }

    /**
     * Set grahamMosPrice.
     *
     * @param string|null $grahamMosPrice
     *
     * @return CompanyAnalysing4m
     */
    public function setGrahamMosPrice($grahamMosPrice = null)
    {
        $this->grahamMosPrice = $grahamMosPrice;

        return $this;
    }

    /**
     * Get grahamMosPrice.
     *
     * @return string|null
     */
    public function getGrahamMosPrice()
    {
        return $this->grahamMosPrice;
    }

    /**
     * Set chosenPrice.
     *
     * @param string|null $chosenPrice
     *
     * @return CompanyAnalysing4m
     */
    public function setChosenPrice($chosenPrice = null)
    {
        $this->chosenPrice = $chosenPrice;

        return $this;
    }

    /**
     * Get chosenPrice.
     *
     * @return string|null
     */
    public function getChosenPrice()
    {
        return $this->chosenPrice;
    }

    /**
     * Set company.
     *
     * @param \App\Domain\Company\Company|null $company
     *
     * @return CompanyAnalysing4m
     */
    public function setCompany(\App\Domain\Company\Company $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company.
     *
     * @return \App\Domain\Company\Company|null
     */
    public function getCompany()
    {
        return $this->company;
    }
}
