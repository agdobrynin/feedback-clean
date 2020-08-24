<?php

declare(strict_types=1);

use Core\Response;

require_once '../autoload.php';

session_start();
$protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP';

try {
    $config = new Core\Config(require '../config.php');
    $routes = require '../routes.php';
    $router = new Core\Router($config);

    foreach ($routes as $uri => $action) {
        $router->add($uri, $action);
    }

    $response = $router->execute();
} catch (\Throwable $exception) {
    $body = <<< EOL
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title>Error</title>
        </head>
        <body>
            <h1>{$exception->getMessage()}</h1>
            <h4>{$exception->getFile()}:{$exception->getLine()}</h4>
            <pre>{$exception->getTraceAsString()}</pre>
        </body>
        </html>
    EOL;

    $response = (new Response())->setBody($body)->setStatusCode(500, 'Server Error!');
}

$response->emit();
