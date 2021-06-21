<?php


namespace App\Infrastructure;


interface FinanceApiClient {

    public function getCompanyCurrentData($code);

    public function getCompanyHistoricalData($code);

}
