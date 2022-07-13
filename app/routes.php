<?php

declare(strict_types=1);

use App\Actions\AuthAction;
use App\Actions\FileAction;
use App\Actions\MonitorAction;
use Slim\App;

return function (App $app) {
    $app->get('/', [MonitorAction::class, 'view'])->add('csrf');

    $app->get('/preview/{name}', [FileAction::class, 'preview']);
    $app->get('/download/{name}', [FileAction::class, 'download']);
    $app->post('/mass', [FileAction::class, 'mass']);
    $app->post('/delete', [FileAction::class, 'delete'])->add('csrf');

    $app->get('/login', [AuthAction::class, 'view_login'])->add('csrf');
    $app->post('/login', [AuthAction::class, 'login'])->add('csrf');
    $app->get('/logout', [AuthAction::class, 'view_logout']);
};
