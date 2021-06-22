<?php


namespace App\Application\Actions\Company;


use App\Domain\Company\Company;
use App\Domain\Company\CompanyAnalyser;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Infrastructure\Helpers\FinanceCalculator;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class AnalyseAction extends \App\Application\Actions\Action {

    /**
     * @inheritDoc
     */
    protected function action(): Response {
        $companyRepo = $this->entityManager->getRepository(Company::class);
        $companies = $companyRepo->findAll();
        $analyser = new CompanyAnalyser(new FinanceCalculator());

        /** @var Company $company */
        foreach ($companies as $company) {
            $analyser->process($company);
            $this->entityManager->flush();
        }

        $this->response->getBody()->write('Analyse done!');
        return $this->response;
    }
}
