<?php


namespace App\Infrastructure;


use App\Infrastructure\FinfoVndSdk\Domain\Company\CompanyCurrentData;
use App\Infrastructure\FinfoVndSdk\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\FinfoVndSdk\Domain\Industry\Industry;

interface FinanceApiClient {

    public function getCompanyCurrentData($code) : CompanyCurrentData ;

    /**
     * @param string $code
     * @return CompanyHistoricalData[]
     */
    public function getCompanyHistoricalData(string $code) : array;

    public function getIndustry(string $industryCode) : Industry;
}
