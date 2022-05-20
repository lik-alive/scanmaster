<?php

declare(strict_types=1);

use App\Actions\AuthAction;
use App\Actions\FileAction;
use App\Actions\MonitorAction;
use Slim\App;

return function (App $app) {
    $app->get('/', [MonitorAction::class, 'view']);
    $app->get('/preview/{name}', [FileAction::class, 'preview']);
    $app->get('/download/{name}', [FileAction::class, 'download']);
    $app->post('/delete/{name}', [FileAction::class, 'delete']);

    $app->get('/login', [AuthAction::class, 'view_login']);
    $app->post('/login', [AuthAction::class, 'login']);
    $app->get('/logout', [AuthAction::class, 'view_logout']);
};
