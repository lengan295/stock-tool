<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', \App\Application\Actions\Homepage\HomepageAction::class);

    $app->get('/import/industry/{industryCode}', \App\Application\Actions\Company\ImportAction::class);

    $app->get('/analyse[/{industryCode}]', \App\Application\Actions\Company\AnalyseAction::class);

    $app->get('/price[/{industryCode}]', \App\Application\Actions\Company\UpdatePriceAction::class);

};
