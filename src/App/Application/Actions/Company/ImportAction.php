<?php


namespace App\Application\Actions\Company;


use anlutro\cURL\cURL;
use App\Domain\Company\CompanyAnalyser;
use App\Domain\Company\CompanyDataImporter;
use App\Domain\Company\CompanyHelper;
use App\Domain\Company\StockPriceUpdater;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Infrastructure\DchartApiSdk\DchartApiClient;
use App\Infrastructure\FinfoVndSdk\FinfoApiClient;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ImportAction extends \App\Application\Actions\Action {

    /**
     * @inheritDoc
     */
    protected function action(): Response {
        $finfoApiClient = new FinfoApiClient($this->logger, new cURL());
        $dchartApiClient = new DchartApiClient($this->logger, new cURL(), $this->settings);

        $industryCode = (string) $this->resolveArg('industryCode');
        $industry = $finfoApiClient->getIndustry($industryCode);

        $codes = $industry->codeList;
        $codeList = explode(',', $codes);

        $dataUpdater = new CompanyDataImporter($this->entityManager, $finfoApiClient);
        $analyser = new CompanyAnalyser(new FinanceCalculator());
        $priceUpdater = new StockPriceUpdater($this->entityManager, $dchartApiClient);

        $helper = new CompanyHelper($this->entityManager, $dataUpdater, $analyser, $priceUpdater);

        foreach ($codeList as $code) {
            $company = $helper->importAndAnalyse($code);
            $company->setCodeIndustry($industryCode);
        }
        $this->entityManager->flush();

        $this->response->getBody()->write('Done!');
        return $this->response;
    }
}
