<?php

namespace App\Domain\Company;

use Doctrine\ORM\Mapping as ORM;

/**
 * CompanyHistoricalData
 *
 * @ORM\Table(name="company_historical_data", uniqueConstraints={@ORM\UniqueConstraint(name="company_historical_data_unique", columns={"code", "report_type", "fiscal_date"})}, indexes={@ORM\Index(name="fiscal_date", columns={"fiscal_date"}), @ORM\Index(name="IDX_EC5B31BF77153098", columns={"code"})})
 * @ORM\Entity
 */
class CompanyHistoricalData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="report_type", type="string", length=0, nullable=true, unique=false)
     */
    private $reportType;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fiscal_date", type="datetime", nullable=true, unique=false)
     */
    private $fiscalDate;

    /**
     * @var int|null
     *
     * @ORM\Column(name="asset_total", type="bigint", nullable=true, unique=false)
     */
    private $assetTotal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="short_term_dept", type="bigint", nullable=true, unique=false)
     */
    private $shortTermDept;

    /**
     * @var int|null
     *
     * @ORM\Column(name="long_term_dept", type="bigint", nullable=true, unique=false)
     */
    private $longTermDept;

    /**
     * @var int|null
     *
     * @ORM\Column(name="equity", type="bigint", nullable=true, unique=false)
     */
    private $equity;

    /**
     * @var int|null
     *
     * @ORM\Column(name="net_income", type="bigint", nullable=true, unique=false)
     */
    private $netIncome;

    /**
     * @var int|null
     *
     * @ORM\Column(name="gross_profit", type="bigint", nullable=true, unique=false)
     */
    private $grossProfit;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nopat", type="bigint", nullable=true, unique=false)
     */
    private $nopat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="operating_cash_flow", type="bigint", nullable=true, unique=false)
     */
    private $operatingCashFlow;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cash_and_cash_equivalents", type="bigint", nullable=true, unique=false)
     */
    private $cashAndCashEquivalents;

    /**
     * @var \App\Domain\Company\Company
     *
     * @ORM\ManyToOne(targetEntity="App\Domain\Company\Company", inversedBy="historicalData")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code", referencedColumnName="code", nullable=true)
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
     * Set reportType.
     *
     * @param string|null $reportType
     *
     * @return CompanyHistoricalData
     */
    public function setReportType($reportType = null)
    {
        $this->reportType = $reportType;

        return $this;
    }

    /**
     * Get reportType.
     *
     * @return string|null
     */
    public function getReportType()
    {
        return $this->reportType;
    }

    /**
     * Set fiscalDate.
     *
     * @param \DateTime|null $fiscalDate
     *
     * @return CompanyHistoricalData
     */
    public function setFiscalDate($fiscalDate = null)
    {
        $this->fiscalDate = $fiscalDate;

        return $this;
    }

    /**
     * Get fiscalDate.
     *
     * @return \DateTime|null
     */
    public function getFiscalDate()
    {
        return $this->fiscalDate;
    }

    /**
     * Set assetTotal.
     *
     * @param int|null $assetTotal
     *
     * @return CompanyHistoricalData
     */
    public function setAssetTotal($assetTotal = null)
    {
        $this->assetTotal = $assetTotal;

        return $this;
    }

    /**
     * Get assetTotal.
     *
     * @return int|null
     */
    public function getAssetTotal()
    {
        return $this->assetTotal;
    }

    /**
     * Set shortTermDept.
     *
     * @param int|null $shortTermDept
     *
     * @return CompanyHistoricalData
     */
    public function setShortTermDept($shortTermDept = null)
    {
        $this->shortTermDept = $shortTermDept;

        return $this;
    }

    /**
     * Get shortTermDept.
     *
     * @return int|null
     */
    public function getShortTermDept()
    {
        return $this->shortTermDept;
    }

    /**
     * Set longTermDept.
     *
     * @param int|null $longTermDept
     *
     * @return CompanyHistoricalData
     */
    public function setLongTermDept($longTermDept = null)
    {
        $this->longTermDept = $longTermDept;

        return $this;
    }

    /**
     * Get longTermDept.
     *
     * @return int|null
     */
    public function getLongTermDept()
    {
        return $this->longTermDept;
    }

    /**
     * Set equity.
     *
     * @param int|null $equity
     *
     * @return CompanyHistoricalData
     */
    public function setEquity($equity = null)
    {
        $this->equity = $equity;

        return $this;
    }

    /**
     * Get equity.
     *
     * @return int|null
     */
    public function getEquity()
    {
        return $this->equity;
    }

    /**
     * Set netIncome.
     *
     * @param int|null $netIncome
     *
     * @return CompanyHistoricalData
     */
    public function setNetIncome($netIncome = null)
    {
        $this->netIncome = $netIncome;

        return $this;
    }

    /**
     * Get netIncome.
     *
     * @return int|null
     */
    public function getNetIncome()
    {
        return $this->netIncome;
    }

    /**
     * Set grossProfit.
     *
     * @param int|null $grossProfit
     *
     * @return CompanyHistoricalData
     */
    public function setGrossProfit($grossProfit = null)
    {
        $this->grossProfit = $grossProfit;

        return $this;
    }

    /**
     * Get grossProfit.
     *
     * @return int|null
     */
    public function getGrossProfit()
    {
        return $this->grossProfit;
    }

    /**
     * Set nopat.
     *
     * @param int|null $nopat
     *
     * @return CompanyHistoricalData
     */
    public function setNopat($nopat = null)
    {
        $this->nopat = $nopat;

        return $this;
    }

    /**
     * Get nopat.
     *
     * @return int|null
     */
    public function getNopat()
    {
        return $this->nopat;
    }

    /**
     * Set operatingCashFlow.
     *
     * @param int|null $operatingCashFlow
     *
     * @return CompanyHistoricalData
     */
    public function setOperatingCashFlow($operatingCashFlow = null)
    {
        $this->operatingCashFlow = $operatingCashFlow;

        return $this;
    }

    /**
     * Get operatingCashFlow.
     *
     * @return int|null
     */
    public function getOperatingCashFlow()
    {
        return $this->operatingCashFlow;
    }

    /**
     * Set cashAndCashEquivalents.
     *
     * @param int|null $cashAndCashEquivalents
     *
     * @return CompanyHistoricalData
     */
    public function setCashAndCashEquivalents($cashAndCashEquivalents = null)
    {
        $this->cashAndCashEquivalents = $cashAndCashEquivalents;

        return $this;
    }

    /**
     * Get cashAndCashEquivalents.
     *
     * @return int|null
     */
    public function getCashAndCashEquivalents()
    {
        return $this->cashAndCashEquivalents;
    }

    /**
     * Set company.
     *
     * @param \App\Domain\Company\Company|null $company
     *
     * @return CompanyHistoricalData
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
