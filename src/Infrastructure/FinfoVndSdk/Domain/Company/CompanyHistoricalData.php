<?php


namespace App\Infrastructure\FinfoVndSdk\Domain\Company;


class CompanyHistoricalData {
    public $assetTotal;
    public $shortTermDept;
    public $longTermDept;
    public $equity;
    public $netIncome;
    public $grossProfit;
    public $nopat;
    public $operatingCashFlow;
    public $cashAndCashEquivalents;

    public $companyCode;
    public $fiscalDate;
    public $reportType;

    public function __construct($companyCode, $reportType, $fiscalDate) {
        $this->companyCode = $companyCode;
        $this->fiscalDate = $fiscalDate;
        $this->reportType = $reportType;
    }
}
