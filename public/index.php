<?php

declare(strict_types=1);

use DI\Container;
use Slim\Factory\AppFactory;
use Dotenv\Dotenv;

// Start PHP session
session_start();

require __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$env = Dotenv::createImmutable(base_path());
$env->safeLoad();

AppFactory::setContainer(new Container());

// // Create app
$app = AppFactory::create();
$app->setBasePath(env('BASE_PATH'));

// Register middlewares
$middlewares = require __DIR__ . '/../app/middlewares.php';
$middlewares($app);

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

// Handle errors
if (env('APP_DEBUG') === true) {
  $app->addErrorMiddleware(true, false, false);
}
try {
  $app->run();
} catch (Exception $e) {
  return $app->getResponseFactory()->createResponse(404);
}
