<?php


namespace App\Domain\Company;


use Doctrine\ORM\EntityManagerInterface;

class CompanyHelper {
    private $dataUpdater;
    private $analyser;
    private $priceUpdater;
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        CompanyDataImporter $dataUpdater,
        CompanyAnalyser $analyser,
        StockPriceUpdater $priceUpdater
    ) {
        $this->entityManager = $entityManager;
        $this->dataUpdater = $dataUpdater;
        $this->analyser = $analyser;
        $this->priceUpdater = $priceUpdater;
    }

    public function importAndAnalyse($code) : Company {
        $dataUpdater = $this->dataUpdater;
        $analyser = $this->analyser;
        $priceUpdater = $this->priceUpdater;

        $company = $dataUpdater->importCompanyData($code);
        // todo : get industryCode

        if (!empty($existing = $company->getAnalysing4m())) {
            $this->entityManager->remove($existing);
        }
        $analysing = $analyser->process($company);
        if (!empty($analysing)) {
            $company->setAnalysing4m($analysing);
            $this->entityManager->persist($analysing);
        }

        $priceUpdater->updateStockPrice($company);

        $this->entityManager->flush();

        return $company;
    }
}
