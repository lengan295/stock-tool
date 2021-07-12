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
            'marketCap' => (float)$company->getMarketCap(),
            'volume10Session' => (float)$company->getVolume10Session(),
            'max52Weeks' => (float)$company->getMax52Weeks(),
            'min52Weeks' => (float)$company->getMin52Weeks(),
            'shares' => (float)$company->getShares(),
            'freeFloat' => (float)$company->getFreeFloat(),
            'beta' => (float)$company->getBeta(),
            'pe' => (float)$company->getPe(),
            'pb' => (float)$company->getPb(),
            'dividendRate' => (float)$company->getDividendRate(),
            'bvps' => (float)$company->getBvps(),
            'roae' => (float)$company->getRoae(),
            'roaa' => (float)$company->getRoaa(),
            'eps' => (float)$company->getEps(),
            'roic' => (float)$company->getRoic(),
            'stockPrice' => (float)$company->getStockPrice(),
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
            'equityGrowRate' => (float)$analysing4m->getEquityGrowRate(),
            'netIncomeGrowRate' => (float)$analysing4m->getNetIncomeGrowRate(),
            'nopatGrowRate' => (float)$analysing4m->getNopatGrowRate(),
            'operatingCashFlowGrowRate' => (float)$analysing4m->getOperatingCashFlowGrowRate(),
            'futureEpsGrowRate' => (float)$analysing4m->getFutureEpsGrowRate(),
            'futurePe' => (float)$analysing4m->getFuturePe(),
            'minimumAcceptableRate' => (float)$analysing4m->getMinimumAcceptableRate(),
            'marginOfSafe' => (float)$analysing4m->getMarginOfSafe(),
            'investmentYears' => (float)$analysing4m->getInvestmentYears(),
            'futureRetailValue' => (float)$analysing4m->getFutureRetailValue(),
            'stickerPrice' => (float)$analysing4m->getStickerPrice(),
            'mosPrice' => (float)$analysing4m->getMosPrice(),
            'grahamPrice' => (float)$analysing4m->getGrahamPrice(),
            'grahamMosPrice' => (float)$analysing4m->getGrahamMosPrice(),
            'chosenPrice' => (float)$analysing4m->getChosenPrice(),
        ];
    }

    private function parseHistoricalDatum(CompanyHistoricalData $datum) {
        return [
            'reportType' => $datum->getReportType(),
            'fiscalDate' => $datum->getFiscalDate(),
            'assetTotal' => (float)$datum->getAssetTotal(),
            'shortTermDept' => (float)$datum->getShortTermDept(),
            'longTermDept' => (float)$datum->getLongTermDept(),
            'equity' => (float)$datum->getEquity(),
            'equityYoy' => (float)$datum->getEquityYoy(),
            'netIncome' => (float)$datum->getNetIncome(),
            'netIncomeYoy' => (float)$datum->getNetIncomeYoy(),
            'grossProfit' => (float)$datum->getGrossProfit(),
            'nopat' => (float)$datum->getNopat(),
            'nopatYoy' => (float)$datum->getNopatYoy(),
            'operatingCashFlow' => (float)$datum->getOperatingCashFlow(),
            'operatingCashFlowYoy' => (float)$datum->getOperatingCashFlowYoy(),
            'cashAndCashEquivalents' => (float)$datum->getCashAndCashEquivalents(),
            'roic' => (float)$datum->getRoic(),
        ];
    }

}
