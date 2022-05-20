<?php

use Psr\Http\Message\ResponseInterface as Response;
use Jenssegers\Blade\Blade;

if (!function_exists('view')) {
  function view(Response $response, $template, $with = [])
  {
    $cache = dirname(__DIR__) . '/storage/cache';
    $views = dirname(__DIR__) . '/resources/views';

    $blade = (new Blade($views, $cache))->make($template, $with);

    $response->getBody()->write($blade->render());

    return $response;
  }
}

if (!function_exists('redirect')) {
  function redirect(Response $response, $path)
  {
    return $response->withHeader('Location', env('BASE_PATH') . $path)->withStatus(302);
  }
}

if (!function_exists('base_path')) {
  function base_path($path = '')
  {
    return  dirname(__DIR__) . "/{$path}";
  }
}

if (!function_exists('storage_path')) {
  function storage_path($path = '')
  {
    return  dirname(__DIR__) . "/storage/{$path}";
  }
}
