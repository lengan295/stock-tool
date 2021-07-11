<?php


namespace App\Application\Actions\Company\Ajax;


use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyHistoricalData;
use App\Domain\DomainException\DomainRecordNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class GetCompanyDataAction extends Action {

    protected function action(): Response {
        $companyCode = $this->resolveArg('companyCode');
        $companyRepo = $this->entityManager->getRepository(Company::class);
        $company = $companyRepo->find($companyCode);

        $data = [
            "company" => $this->parseCompany($company)
        ];

        return $this->respondWithData($data);
    }

    private function parseCompany(Company $company) {
        $generalInfo = [
            'code' => $company->getCode(),
            'name' => $company->getName(),
            'codeIndustry' => $company->getCodeIndustry(),
            'marketCap' => $company->getMarketCap(),
            'volume10Session' => $company->getVolume10Session(),
            'max52Weeks' => $company->getMax52Weeks(),
            'min52Weeks' => $company->getMin52Weeks(),
            'shares' => $company->getShares(),
            'freeFloat' => $company->getFreeFloat(),
            'beta' => $company->getBeta(),
            'pe' => $company->getPe(),
            'pb' => $company->getPb(),
            'dividendRate' => $company->getDividendRate(),
            'bvps' => $company->getBvps(),
            'roae' => $company->getRoae(),
            'roaa' => $company->getRoaa(),
            'eps' => $company->getEps(),
            'roic' => $company->getRoic(),
            'stockPrice' => $company->getStockPrice(),
            'priceUpdateAt' => $company->getPriceUpdateAt(),
        ];

        $analysing4m = $this->parseAnalysing4m($company->getAnalysing4m());
        $historicalData = array_map([$this, 'parseHistoricalDatum'], $company->getHistoricalData()->toArray());

        return [
            'generalInfo' => $generalInfo,
            'analysing4m' => $analysing4m,
            'historicalData' => $historicalData,
        ];
    }

    private function parseAnalysing4m(\App\Domain\Company\CompanyAnalysing4m $analysing4m) {
        return [
            'beginYear' => $analysing4m->getBeginYear(),
            'endYear' => $analysing4m->getEndYear(),
            'equityGrowRate' => $analysing4m->getEquityGrowRate(),
            'netIncomeGrowRate' => $analysing4m->getNetIncomeGrowRate(),
            'nopatGrowRate' => $analysing4m->getNopatGrowRate(),
            'operatingCashFlowGrowRate' => $analysing4m->getOperatingCashFlowGrowRate(),
            'futureEpsGrowRate' => $analysing4m->getFutureEpsGrowRate(),
            'futurePe' => $analysing4m->getFuturePe(),
            'minimumAcceptableRate' => $analysing4m->getMinimumAcceptableRate(),
            'marginOfSafe' => $analysing4m->getMarginOfSafe(),
            'investmentYears' => $analysing4m->getInvestmentYears(),
            'futureRetailValue' => $analysing4m->getFutureRetailValue(),
            'stickerPrice' => $analysing4m->getStickerPrice(),
            'mosPrice' => $analysing4m->getMosPrice(),
            'grahamPrice' => $analysing4m->getGrahamPrice(),
            'grahamMosPrice' => $analysing4m->getGrahamMosPrice(),
            'chosenPrice' => $analysing4m->getChosenPrice(),
        ];
    }

    private function parseHistoricalDatum(CompanyHistoricalData $datum) {
        return [
            'reportType' => $datum->getReportType(),
            'fiscalDate' => $datum->getFiscalDate(),
            'assetTotal' => $datum->getAssetTotal(),
            'shortTermDept' => $datum->getShortTermDept(),
            'longTermDept' => $datum->getLongTermDept(),
            'equity' => $datum->getEquity(),
            'equityYoy' => $datum->getEquityYoy(),
            'netIncome' => $datum->getNetIncome(),
            'netIncomeYoy' => $datum->getNetIncomeYoy(),
            'grossProfit' => $datum->getGrossProfit(),
            'nopat' => $datum->getNopat(),
            'nopatYoy' => $datum->getNopatYoy(),
            'operatingCashFlow' => $datum->getOperatingCashFlow(),
            'operatingCashFlowYoy' => $datum->getOperatingCashFlowYoy(),
            'cashAndCashEquivalents' => $datum->getCashAndCashEquivalents(),
            'roic' => $datum->getRoic(),
        ];
    }

}
