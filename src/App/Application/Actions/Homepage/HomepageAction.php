<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\DchartApiSdk\DchartApiClient;
use App\Infrastructure\FinfoVndSdk\FinfoApiClient;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $api = new FinfoApiClient($this->logger, new cURL());
        $r = $api->getIndustry('8600');

        $this->response->getBody()->write('r = ' . print_r($r,1));
        return $this->response;
    }
}
