<?php


namespace App\Application\Actions\Company;


use anlutro\cURL\cURL;
use App\Domain\Company\Company;
use App\Domain\Company\StockPriceUpdater;
use App\Infrastructure\DchartApiSdk\DchartApiClient;
use Psr\Http\Message\ResponseInterface as Response;

class UpdatePriceAction extends \App\Application\Actions\Action {

    /**
     * @inheritDoc
     */
    protected function action(): Response {
        $companyRepo = $this->entityManager->getRepository(Company::class);

        $companies = $companyRepo->findAll();
        $apiClient = new DchartApiClient($this->logger, new cURL());
        $updater = new StockPriceUpdater($this->entityManager, $apiClient);

        /** @var Company $company */
        foreach ($companies as $company) {
            $updater->updateStockPrice($company);
        }
        $this->entityManager->flush();

        $this->response->getBody()->write('Update done!');
        return $this->response;
    }
}
