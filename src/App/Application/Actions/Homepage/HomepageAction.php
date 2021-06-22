<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\FinfoVndSdk\ApiClient;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $c = new FinanceCalculator();

        $r = $c->rate(200, 121, 2);

        $this->response->getBody()->write('r = ' . $r);
        return $this->response;
    }
}
