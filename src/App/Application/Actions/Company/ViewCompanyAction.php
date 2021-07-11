<?php


namespace App\Application\Actions\Company;


use App\Application\Actions\ViewAction;
use App\Domain\Company\Company;
use Psr\Http\Message\ResponseInterface as Response;

class ViewCompanyAction extends ViewAction {

    protected function action(): Response {
        $companyCode = $this->resolveArg('companyCode');

        $data = ['companyCode' => $companyCode];

        $response = $this->render('view_company.phtml', $data);
        return $response;
    }
}
