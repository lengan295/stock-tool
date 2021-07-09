<?php


namespace App\Domain\Company;



use App\Infrastructure\FinanceApiClient;
use Doctrine\ORM\EntityManagerInterface;

class CompanyDataImporter {
    private $entityManager;
    private $apiClient;

    public function __construct(EntityManagerInterface $entityManager, FinanceApiClient $apiClient) {
        $this->entityManager = $entityManager;
        $this->apiClient = $apiClient;
    }

    public function importCompanyData($code, $refreshHistoricalData = false) : Company {
        $api = $this->apiClient;
        $data = $api->getCompanyCurrentData($code);

        $company = $this->entityManager->find(Company::class, $code);
        if (empty($company)) {
            $company = new Company();
        }
        $company->setCode($data->code);
        $company->setMarketCap($data->marketCap);
        $company->setVolume10Session($data->volume10Session);
        $company->setMax52Weeks($data->max52Weeks);
        $company->setMin52Weeks($data->min52Weeks);
        $company->setShares($data->shares);
        $company->setFreeFloat($data->freeFloat);
        $company->setBeta($data->beta);
        $company->setPe($data->pe);
        $company->setPb($data->pb);
        $company->setDividendRate($data->dividendRate);
        $company->setBvps($data->bvps);
        $company->setRoae($data->roae);
        $company->setRoaa($data->roaa);
        $company->setEps($data->eps);

        $historicalData = $api->getCompanyHistoricalData($code);
        foreach ($historicalData as $reportType => $data) {
            /** @var \App\Infrastructure\FinfoVndSdk\Domain\Company\CompanyHistoricalData $datum */
            foreach ($data as $datum) {
                $foundHistoricalData = $this->entityManager->getRepository(CompanyHistoricalData::class)
                    ->findBy(['company' => $company, 'reportType' => $datum->reportType, 'fiscalDate' => $datum->fiscalDate]);
                if (empty($foundHistoricalData)) {
                    $historicalDatum = new CompanyHistoricalData();
                } else {
                    if (!$refreshHistoricalData) {
                        continue;
                    }
                    $historicalDatum = reset($foundHistoricalData);
                }

                $historicalDatum->setAssetTotal($datum->assetTotal);
                $historicalDatum->setShortTermDept($datum->shortTermDept);
                $historicalDatum->setLongTermDept($datum->longTermDept);
                $historicalDatum->setEquity($datum->equity);
                $historicalDatum->setNetIncome($datum->netIncome);
                $historicalDatum->setGrossProfit($datum->grossProfit);
                $historicalDatum->setNopat($datum->nopat);
                $historicalDatum->setOperatingCashFlow($datum->operatingCashFlow);
                $historicalDatum->setCashAndCashEquivalents($datum->cashAndCashEquivalents);
                $historicalDatum->setFiscalDate($datum->fiscalDate);
                $historicalDatum->setReportType($datum->reportType);
                $historicalDatum->setCompany($company);

                $this->entityManager->persist($historicalDatum);
                $company->addHistoricalDatum($historicalDatum);
            }
        }
        $this->entityManager->persist($company);
        return $company;
    }
}
