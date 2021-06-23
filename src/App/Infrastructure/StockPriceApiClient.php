<?php


namespace App\Infrastructure;


interface StockPriceApiClient {

    public function getPrice($code);

}
