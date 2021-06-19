<?php


namespace App\Infrastructure\FinfoVndSdk;


use App\Infrastructure\FinfoVndSdk\Domain\Company\CompanyCurrentDataParser;
use Psr\Log\LoggerInterface;

class ApiClient {
    const URL_BASE = "https://finfo-api.vndirect.com.vn/v4/";

    public function __construct(LoggerInterface $logger) {
        $this->logger = $logger;
    }

    public function getCompanyCurrentData($code) {
        $itemCodeList =
            CompanyCurrentDataParser::ITEM_CODE_MARKET_CAP . "," .
            CompanyCurrentDataParser::ITEM_CODE_VOLUME_10_SESSION . "," .
            CompanyCurrentDataParser::ITEM_CODE_MAX_52_WEEKS . "," .
            CompanyCurrentDataParser::ITEM_CODE_MIN_52_WEEKS . "," .
            CompanyCurrentDataParser::ITEM_CODE_SHARES . "," .
            CompanyCurrentDataParser::ITEM_CODE_FREE_FLOAT . "," .
            CompanyCurrentDataParser::ITEM_CODE_BETA . "," .
            CompanyCurrentDataParser::ITEM_CODE_PE . "," .
            CompanyCurrentDataParser::ITEM_CODE_PB . "," .
            CompanyCurrentDataParser::ITEM_CODE_DIVIDEND_RATE . "," .
            CompanyCurrentDataParser::ITEM_CODE_BVPS . "," .
            CompanyCurrentDataParser::ITEM_CODE_ROAE . "," .
            CompanyCurrentDataParser::ITEM_CODE_ROAA . "," .
            CompanyCurrentDataParser::ITEM_CODE_EPS . ",";
        $url = self::URL_BASE . "ratios/latest?filter=itemCode:" . $itemCodeList . "&where=code:" . $code . "&order=reportDate&fields=itemCode,value";
        $this->logger->debug('url : ' . $url);
    }
}
