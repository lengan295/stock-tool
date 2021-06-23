<?php


namespace App\Application\Actions\Company;


use anlutro\cURL\cURL;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Infrastructure\FinfoVndSdk\FinfoApiClient;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ImportAction extends \App\Application\Actions\Action {

    /**
     * @inheritDoc
     */
    protected function action(): Response {
        $api = new FinfoApiClient($this->logger, new cURL());

        $industryCode = (string) $this->resolveArg('industryCode');
        $industry = $api->getIndustry($industryCode);

        $codes = $industry->codeList;
        $codeList = explode(',', $codes);

        $u = new CompanyDataUpdater($this->entityManager, $api);

        foreach ($codeList as $code) {
            $u->updateCompanyData($code);
            $this->entityManager->flush();
        }

        $this->response->getBody()->write('Done!');
        return $this->response;
    }
}
