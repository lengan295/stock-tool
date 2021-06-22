<?php


namespace App\Domain\Company;


use App\Infrastructure\Helpers\FinanceCalculator;

class CompanyAnalyser {

    private $calculator;

    public function __construct(FinanceCalculator $calculator) {
        $this->calculator = $calculator;
    }

    public function process(Company $company) {
        $historicalData = $this->indexHistoricalDataByYear($company->getHistoricalData());

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
        }
    }

    private function indexHistoricalDataByYear(\Doctrine\Common\Collections\ArrayCollection $historicalData) {
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
}
