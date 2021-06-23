<?php


namespace App\Domain\Company;


use App\Infrastructure\StockPriceApiClient;
use Doctrine\ORM\EntityManagerInterface;

class StockPriceUpdater {
    private $entityManager;
    private $apiClient;

    public function __construct(EntityManagerInterface $entityManager, StockPriceApiClient $apiClient) {
        $this->entityManager = $entityManager;
        $this->apiClient = $apiClient;
    }

    public function updateStockPrice(Company $company) {
        $stockPrice = $this->apiClient->getPrice($company->getCode());
        $company->setStockPrice($stockPrice->price);
        $company->setPriceUpdateAt($stockPrice->time);
    }
}
