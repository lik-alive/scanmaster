<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Container\ContainerInterface;

class AuthAction
{
    private $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function view_login(Request $request, Response $response)
    {
        if (isset($_SESSION['user'])) {
            return redirect($response, '/');
        }

        $data = [
            'csrf_name' => $request->getAttribute('csrf_name'),
            'csrf_value' => $request->getAttribute('csrf_value'),
            'error' => $_SESSION['error']
        ];
        $_SESSION['error'] = null;

        return view($response, 'login', $data);
    }

    public function login(Request $request, Response $response): Response
    {
        $all = $request->getParsedBody();
        if ($all['username'] !== env('USERNAME') || $all['password'] !== env('PASSWORD')) {
            $_SESSION['error'] = 'Неверное имя пользователя/пароль';

            return redirect($response, '/login');

            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(401);
        }

        $_SESSION['user'] = 'Authorized';

        return redirect($response, '/');
    }

    public function view_logout(Request $request, Response $response): Response
    {
        $_SESSION['user'] = null;

        return redirect($response, '/login');
    }
}
