<?php


namespace App\Application\Actions\Homepage;


use App\Application\Actions\Action;
use App\Infrastructure\FinfoVndSdk\ApiClient;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $api = new ApiClient($this->logger);
        $api->getCompanyCurrentData('CRE');
        $this->logger->info("Homepage was viewed.");

        $this->response->getBody()->write("Hello man");
        return $this->response;
    }
}
