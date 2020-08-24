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

    $responseCode = 200;
    $header = sprintf('%s/1.1 %s %s', $protocol, $responseCode, 'OK');
    $response = $router->execute();
} catch (\Throwable $exception) {
    $responseCode = 500;
    $header = sprintf('%s/1.1 %s %s', $protocol, $responseCode, 'Server Error!');
    $body = $exception->getFile().PHP_EOL.$exception->getMessage().PHP_EOL.$exception->getTraceAsString();
    $response = (new Response())->setBody($body);
}

$response->emit();
