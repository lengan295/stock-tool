<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\FinfoVndSdk\ApiClient;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $api = new ApiClient($this->logger, new cURL());

        $code = 'VHM';

        $u = new CompanyDataUpdater($this->entityManager, $api);
        $u->updateCompanyData($code);

        $this->entityManager->flush();

        $this->response->getBody()->write('Done!');
        return $this->response;
    }
}
