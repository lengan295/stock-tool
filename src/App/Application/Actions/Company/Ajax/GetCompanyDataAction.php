<?php


namespace App\Application\Actions\Company\Ajax;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyAnalyser;
use App\Domain\Company\CompanyDataImporter;
use App\Domain\Company\CompanyHelper;
use App\Domain\Company\CompanyHistoricalData;
use App\Domain\Company\StockPriceUpdater;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Infrastructure\DchartApiSdk\DchartApiClient;
use App\Infrastructure\FinfoVndSdk\FinfoApiClient;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class GetCompanyDataAction extends Action {

    protected function action(): Response {
        $companyCode = $this->resolveArg('companyCode');
        $companyRepo = $this->entityManager->getRepository(Company::class);
        $company = $companyRepo->find($companyCode);

        if (empty($company)) {
            $finfoApiClient = new FinfoApiClient($this->logger, new cURL());
            $dchartApiClient = new DchartApiClient($this->logger, new cURL(), $this->settings);

            $dataUpdater = new CompanyDataImporter($this->entityManager, $finfoApiClient);
            $analyser = new CompanyAnalyser(new FinanceCalculator());
            $priceUpdater = new StockPriceUpdater($this->entityManager, $dchartApiClient);

            $helper = new CompanyHelper($this->entityManager, $dataUpdater, $analyser, $priceUpdater);

            $company = $helper->importAndAnalyse($companyCode);
        }

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
            'assetTotal' => $this->toNumberOrNull($datum->getAssetTotal()),
            'shortTermDept' => $this->toNumberOrNull($datum->getShortTermDept()),
            'longTermDept' => $this->toNumberOrNull($datum->getLongTermDept()),
            'equity' => $this->toNumberOrNull($datum->getEquity()),
            'equityYoy' => $this->toNumberOrNull($datum->getEquityYoy()),
            'netIncome' => $this->toNumberOrNull($datum->getNetIncome()),
            'netIncomeYoy' => $this->toNumberOrNull($datum->getNetIncomeYoy()),
            'grossProfit' => $this->toNumberOrNull($datum->getGrossProfit()),
            'nopat' => $this->toNumberOrNull($datum->getNopat()),
            'nopatYoy' => $this->toNumberOrNull($datum->getNopatYoy()),
            'operatingCashFlow' => $this->toNumberOrNull($datum->getOperatingCashFlow()),
            'operatingCashFlowYoy' => $this->toNumberOrNull($datum->getOperatingCashFlowYoy()),
            'cashAndCashEquivalents' => $this->toNumberOrNull($datum->getCashAndCashEquivalents()),
            'roic' => $this->toNumberOrNull($datum->getRoic()),
        ];
    }

    private function toNumberOrNull($value) {
        if (is_null($value)) {
            return $value;
        }

        return floatval($value);
    }
}
