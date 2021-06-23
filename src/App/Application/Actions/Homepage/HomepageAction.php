<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\DchartApiSdk\DchartApiClient;
use App\Infrastructure\FinfoVndSdk\ApiClient;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {

        $t = new \DateTime('@1624422421');
//        $t->setTimezone(new \DateTimeZone('Asia/Ho_Chi_Minh'));
        $t->setTimezone(new \DateTimeZone($this->settings->get('timezone')));
        $r = $t->format('Y-m-d H:i:sP');
        $this->response->getBody()->write('r = ' . print_r($r,1));
        return $this->response;
    }
}
