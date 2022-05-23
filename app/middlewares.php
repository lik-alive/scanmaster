<?php

declare(strict_types=1);

use Slim\App;
use Slim\Csrf\Guard;

return function (App $app) {
    $container = $app->getContainer();
    $responseFactory = $app->getResponseFactory();

    // Register Middleware On Container
    $container->set('csrf', function () use ($responseFactory) {
        return new Guard($responseFactory);
    });

    // Register Middleware To Be Executed On All Routes
    // $app->add('csrf');
};
