<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Application\Actions\ViewAction;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyDataImporter;
use App\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\DchartApiSdk\DchartApiClient;
use App\Infrastructure\FinfoVndSdk\FinfoApiClient;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends ViewAction {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $response = $this->render('home.phtml');
        return $response;
    }
}
