<?php


namespace App\Infrastructure;


use App\Infrastructure\DchartApiSdk\Domain\StockPrice\StockPrice;

interface StockPriceApiClient {

    public function getPrice($code) : StockPrice;

}
