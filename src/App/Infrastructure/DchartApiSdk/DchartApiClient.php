<?php


namespace App\Infrastructure\DchartApiSdk;


use anlutro\cURL\cURL;
use App\Application\Settings\SettingsInterface;
use App\Infrastructure\DchartApiSdk\Domain\StockPrice\StockPrice;
use App\Infrastructure\DchartApiSdk\Domain\StockPrice\StockPriceParser;
use App\Infrastructure\StockPriceApiClient;
use Psr\Log\LoggerInterface;

class DchartApiClient implements StockPriceApiClient {
    const URL_BASE = "https://dchart-api.vndirect.com.vn/";

    /**
     * @var LoggerInterface
     */
    private $logger;

    /** @var cURL */
    private $curl;

    /**
     * @var SettingsInterface
     */
    private $settings;

    public function __construct(LoggerInterface $logger, $curl, SettingsInterface $settings) {
        $this->logger = $logger;
        $this->curl = $curl;
        $this->settings = $settings;
    }

    public function getPrice($code) : StockPrice {
        $url = self::URL_BASE . "dchart/history?resolution=D&symbol=$code";

        $response = $this->invokeGet($url);
        $parser = new StockPriceParser($this->logger, $this->settings);
        $stockPrice = $parser->parse($response);

        return $stockPrice;
    }

    private function invokeGet(string $url) {
        $response = $this->curl->get($url);
        $body = json_decode($response->getBody(), true);

        if ($response->statusCode != 200) {
            $this->logger->error(self::class . ":" . __FUNCTION__, (array)$body);
            throw new DchartApiException('API error (' . $body["error"] . ") : " . $body["message"]);
        }

        return $body;
    }

}
