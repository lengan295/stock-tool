<?php


namespace App\Infrastructure\FinfoVndSdk\Domain\Company;


class CompanyCurrentDataParser {
    const ITEM_CODE_MARKET_CAP = "51003";
    const ITEM_CODE_VOLUME_10_SESSION = "51016";
    const ITEM_CODE_MAX_52_WEEKS = "51001";
    const ITEM_CODE_MIN_52_WEEKS = "51002";
    const ITEM_CODE_SHARES = "51004";
    const ITEM_CODE_FREE_FLOAT = "57066";
    const ITEM_CODE_BETA = "51007";
    const ITEM_CODE_PE = "51006";
    const ITEM_CODE_PB = "51012";
    const ITEM_CODE_DIVIDEND_RATE = "51033";
    const ITEM_CODE_BVPS = "51035";
    const ITEM_CODE_ROAE = "52002";
    const ITEM_CODE_ROAA = "52001";
    const ITEM_CODE_EPS = "53007";

    public function parse(array $raw_response) : CompanyCurrentData {
        $data = new CompanyCurrentData();
        if (empty($raw_response["data"])) {
            return $data;
        }
        foreach ($raw_response["data"] as $item) {
            switch($item["itemCode"]) {
                case self::ITEM_CODE_MARKET_CAP :
                    $data->market_cap = $item["value"];
                    break;
                case self::ITEM_CODE_VOLUME_10_SESSION :
                    $data->volume_10_session = $item["value"];
                    break;
                case self::ITEM_CODE_MAX_52_WEEKS :
                    $data->max_52_weeks = $item["value"];
                    break;
                case self::ITEM_CODE_MIN_52_WEEKS :
                    $data->min_52_weeks = $item["value"];
                    break;
                case self::ITEM_CODE_SHARES :
                    $data->shares = $item["value"];
                    break;
                case self::ITEM_CODE_FREE_FLOAT :
                    $data->free_float = $item["value"];
                    break;
                case self::ITEM_CODE_BETA :
                    $data->beta = $item["value"];
                    break;
                case self::ITEM_CODE_PE :
                    $data->pe = $item["value"];
                    break;
                case self::ITEM_CODE_PB :
                    $data->pb = $item["value"];
                    break;
                case self::ITEM_CODE_DIVIDEND_RATE :
                    $data->dividend_rate = $item["value"];
                    break;
                case self::ITEM_CODE_BVPS :
                    $data->bvps = $item["value"];
                    break;
                case self::ITEM_CODE_ROAE :
                    $data->roae = $item["value"];
                    break;
                case self::ITEM_CODE_ROAA :
                    $data->roaa = $item["value"];
                    break;
                case self::ITEM_CODE_EPS :
                    $data->eps = $item["value"];
                    break;
            }
        }
        return $data;
    }

}
