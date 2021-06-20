<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Infrastructure\FinfoVndSdk\ApiClient;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $api = new ApiClient($this->logger, new cURL());

        $code = 'VHM';

        $data = $api->getCompanyCurrentData($code);

        $company = $this->entityManager->find(Company::class, $code);
        if (empty($company)) {
            $company = new Company();
        }
        $company->setCode($data->code);
        $company->setMarketCap($data->marketCap);
        $company->setVolume10Session($data->volume10Session);
        $company->setMax52Weeks($data->max52Weeks);
        $company->setMin52Weeks($data->min52Weeks);
        $company->setShares($data->shares);
        $company->setFreeFloat($data->freeFloat);
        $company->setBeta($data->beta);
        $company->setPe($data->pe);
        $company->setPb($data->pb);
        $company->setDividendRate($data->dividendRate);
        $company->setBvps($data->bvps);
        $company->setRoae($data->roae);
        $company->setRoaa($data->roaa);
        $company->setEps($data->eps);

        $this->entityManager->persist($company);
        $this->entityManager->flush();

        return $this->respondWithData($data);
    }
}
