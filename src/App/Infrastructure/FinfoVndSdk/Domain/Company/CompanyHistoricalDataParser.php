<?php


namespace App\Infrastructure\FinfoVndSdk\Domain\Company;


class CompanyHistoricalDataParser {
    const ITEM_CODE_ASSET_TOTAL = "12700";
    const ITEM_CODE_SHORT_TERM_DEPT = "13100";
    const ITEM_CODE_LONG_TERM_DEPT = "13300";
    const ITEM_CODE_EQUITY = "14000";
    const ITEM_CODE_NET_INCOME = "21001";
    const ITEM_CODE_GROSS_PROFIT = "23100";
    const ITEM_CODE_NOPAT = "23000";
    const ITEM_CODE_OPERATING_CASH_FLOW = "32000";
    const ITEM_CODE_CASH_AND_CASH_EQUIVALENTS = "37000";

    public function parse(array $raw_response) : array {
        if (empty($raw_response["data"]["hits"])) {
            return array();
        }

        $dataSet = array();

        foreach ($raw_response["data"]["hits"] as $item) {
            $source = $item["_source"];
            $companyCode = $source["secCode"];
            $fiscalDate = $source["fiscalDate"];
            $reportType = $source["reportType"];
            if (empty($dataSet[$reportType][$fiscalDate])) {
                $dataSet[$reportType][$fiscalDate] = new CompanyHistoricalData($companyCode, $reportType, $fiscalDate);
            }

            $this->updateEntity($dataSet[$reportType][$fiscalDate], $source);
        }

        return $dataSet;
    }

    private function updateEntity(CompanyHistoricalData $entity, $source) {
        switch ($source["itemCode"]) {
            case self::ITEM_CODE_ASSET_TOTAL :
                $entity->assetTotal = $source["numericValue"];
                break;
            case self::ITEM_CODE_SHORT_TERM_DEPT :
                $entity->shortTermDept = $source["numericValue"];
                break;
            case self::ITEM_CODE_LONG_TERM_DEPT :
                $entity->longTermDept = $source["numericValue"];
                break;
            case self::ITEM_CODE_EQUITY :
                $entity->equity = $source["numericValue"];
                break;
            case self::ITEM_CODE_NET_INCOME :
                $entity->netIncome = $source["numericValue"];
                break;
            case self::ITEM_CODE_GROSS_PROFIT :
                $entity->grossProfit = $source["numericValue"];
                break;
            case self::ITEM_CODE_NOPAT :
                $entity->nopat = $source["numericValue"];
                break;
            case self::ITEM_CODE_OPERATING_CASH_FLOW :
                $entity->operatingCashFlow = $source["numericValue"];
                break;
            case self::ITEM_CODE_CASH_AND_CASH_EQUIVALENTS :
                $entity->cashAndCashEquivalents = $source["numericValue"];
                break;
        }
    }

}
