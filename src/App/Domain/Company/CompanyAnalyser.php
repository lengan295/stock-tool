<?php


namespace App\Domain\Company;


use App\Infrastructure\Helpers\FinanceCalculator;

class CompanyAnalyser {
    const FUTURE_PE = 10;
    const MINIMUM_ACCEPTABLE_RATE = 0.15;
    const MOS = 0.25;
    const INVESTMENT_YEARS = 5;
    const GRAHAM_COEFFICIENT = 22.5;

    private $calculator;

    public function __construct(FinanceCalculator $calculator) {
        $this->calculator = $calculator;
    }

    public function process(Company $company, $beginYear = null) {
        /** @var CompanyHistoricalData[] $historicalData */
        $historicalData = $this->indexHistoricalDataByYear($company->getHistoricalData());
        if (count($historicalData) < 2) {
            return null;
        }

        $minYear = $maxYear = null;

        /**
         * @var int $year
         * @var CompanyHistoricalData $datum
         */
        foreach ($historicalData as $year => $datum) {
            if (!empty($historicalData[$year - 1])) {
                $this->processYoyData($datum, $historicalData[$year - 1]);
            }

            $roic = $this->calculator->roic($datum->getNopat(), $datum->getEquity(), $datum->getLongTermDept());
            $datum->setRoic($roic);

            if (!isset($minYear) || $year < $minYear) {
                $minYear = $year;
            }
            if (!isset($maxYear) || $year > $maxYear) {
                $maxYear = $year;
            }
        }

        if (!isset($beginYear) || $beginYear < $minYear) {
            $beginYear = $minYear;
        }

        $roic = $historicalData[$maxYear]->getRoic();
        $company->setRoic($roic);

        return $this->process4m($company, $historicalData, $beginYear, $maxYear);
    }

    private function indexHistoricalDataByYear(\Doctrine\Common\Collections\Collection $historicalData) {
        $indexedArray = array();
        /** @var CompanyHistoricalData $datum */
        foreach ($historicalData as $datum) {
            $year = $datum->getFiscalDate()->format('Y');
            $indexedArray[$year] = $datum;
        }
        return $indexedArray;
    }

    private function processYoyData(CompanyHistoricalData $datum, CompanyHistoricalData $previousYearDatum) {
        $equityYoy = $this->calculator->rate($previousYearDatum->getEquity(), $datum->getEquity(), 1);
        $netIncomeYoy = $this->calculator->rate($previousYearDatum->getNetIncome(), $datum->getNetIncome(), 1);
        $nopatYoy = $this->calculator->rate($previousYearDatum->getNopat(), $datum->getNopat(), 1);
        $cashFlowYoy = $this->calculator->rate($previousYearDatum->getOperatingCashFlow(), $datum->getOperatingCashFlow(), 1);

        $datum->setEquityYoy($equityYoy);
        $datum->setNetIncomeYoy($netIncomeYoy);
        $datum->setNopatYoy($nopatYoy);
        $datum->setOperatingCashFlowYoy($cashFlowYoy);
    }

    /**
     * @param Company $company
     * @param CompanyHistoricalData[] $historicalData
     * @param $beginYear
     * @param $endYear
     * @return CompanyAnalysing4m
     */
    private function process4m(Company $company, array $historicalData, $beginYear, $endYear) {
        $age = $endYear - $beginYear;
        $beginData = $historicalData[$beginYear];
        $endData = $historicalData[$endYear];

        $equityGrowRate = $this->calculator->rate($beginData->getEquity(), $endData->getEquity(), $age);
        $netIncomeGrowRate = $this->calculator->rate($beginData->getNetIncome(), $endData->getNetIncome(), $age);
        $nopatGrowRate = $this->calculator->rate($beginData->getNopat(), $endData->getNopat(), $age);
        $operatingCashFlowGrowRate = $this->calculator->rate($beginData->getOperatingCashFlow(), $endData->getOperatingCashFlow(), $age);

        $futureEpsGrowRate = $nopatGrowRate;
        $futurePe = self::FUTURE_PE;
        $minimumAcceptableRate = self::MINIMUM_ACCEPTABLE_RATE;
        $marginOfSafe = self::MOS;
        $investmentYears = self::INVESTMENT_YEARS;

        $futureEps = $this->calculator->futureValue($company->getEps(), $futureEpsGrowRate, $investmentYears);
        $futureRetailValue = $futureEps * $futurePe;
        $stickerPrice = $this->calculator->futureValue($futureRetailValue, -$minimumAcceptableRate, $investmentYears);
        $mosPrice = $stickerPrice * (1 - $marginOfSafe);

        $grahamPrice = (self::GRAHAM_COEFFICIENT * $company->getEps() * $company->getBvps()) ** 0.5;
        $grahamMosPrice = $grahamPrice * (1 - $marginOfSafe);

        $chosenPrice = min($mosPrice, $grahamMosPrice);

        $analysing = new CompanyAnalysing4m();
        $analysing->setCompany($company);
        $analysing->setEquityGrowRate($equityGrowRate);
        $analysing->setNetIncomeGrowRate($netIncomeGrowRate);
        $analysing->setNopatGrowRate($nopatGrowRate);
        $analysing->setOperatingCashFlowGrowRate($operatingCashFlowGrowRate);
        $analysing->setFutureEpsGrowRate($futureEpsGrowRate);
        $analysing->setFuturePe($futurePe);
        $analysing->setMinimumAcceptableRate($minimumAcceptableRate);
        $analysing->setMarginOfSafe($marginOfSafe);
        $analysing->setFutureRetailValue($futureRetailValue);
        $analysing->setStickerPrice($stickerPrice);
        $analysing->setMosPrice($mosPrice);
        $analysing->setGrahamPrice($grahamPrice);
        $analysing->setGrahamMosPrice($grahamMosPrice);
        $analysing->setChosenPrice($chosenPrice);
        $analysing->setInvestmentYears($investmentYears);

        return $analysing;
    }
}
