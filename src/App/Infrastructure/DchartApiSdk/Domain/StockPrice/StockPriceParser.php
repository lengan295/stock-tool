<?php


namespace App\Infrastructure\DchartApiSdk\Domain\StockPrice;


use App\Infrastructure\DchartApiSdk\DchartApiException;
use Psr\Log\LoggerInterface;

class StockPriceParser {
    private $logger;

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function parse($response) : StockPrice {
        if (empty($response["c"]) || empty($response["t"])) {
            $errorMsg = "API ERROR : 'c' or 't' not present";
            $this->logger->error($errorMsg, ["response" => $response]);
            throw new DchartApiException($errorMsg);
        }

        $price = end($response["c"]) * 1000;
        $timestamp = end($response["t"]);
        $time = new \DateTime('@' . $timestamp);

        $stockPrice = new StockPrice();
        $stockPrice->price = $price;
        $stockPrice->time = $time;
        return $stockPrice;
    }
}
