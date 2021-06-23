<?php


namespace App\Infrastructure\DchartApiSdk\Domain\StockPrice;


use App\Application\Settings\SettingsInterface;
use App\Infrastructure\DchartApiSdk\DchartApiException;
use Psr\Log\LoggerInterface;

class StockPriceParser {
    private $logger;
    private $settings;

    public function __construct(LoggerInterface $logger, SettingsInterface $settings) {
        $this->logger = $logger;
        $this->settings = $settings;
    }

    public function parse($response) : StockPrice {
        $stockPrice = new StockPrice();
        if (empty($response["c"]) || empty($response["t"])) {
            $errorMsg = "API ERROR : 'c' or 't' not present";
            $this->logger->warning($errorMsg, ["response" => $response]);
            return $stockPrice;
        }

        $price = end($response["c"]) * 1000;
        $timestamp = end($response["t"]);
        $time = new \DateTime('@' . $timestamp);
        $time->setTimezone(new \DateTimeZone($this->settings->get('timezone')));

        $stockPrice->price = $price;
        $stockPrice->time = $time;
        return $stockPrice;
    }
}
