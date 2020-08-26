<?php

declare(strict_types=1);

require_once '../autoload.php';

session_start();

try {
    $router = require '../boostrap.php';
    $response = $router->execute();
} catch (\Throwable $exception) {
    $response = new Core\Response();
    // Всегда в заголовке отдавать CSRF токен.
    (new Core\Csrf())->setToken($response);
    if ($router->isAjax()) {
        $data = [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTrace(),
        ];
        $response->setJson($data);
    } else {
        $body = <<< EOL
        <!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>Error</title></head><body>
            <h1>{$exception->getMessage()}</h1>
            <h4>{$exception->getFile()}:{$exception->getLine()}</h4>
            <pre>{$exception->getTraceAsString()}</pre>
        </body></html>
        EOL;
        $response->setBody($body);
    }

    $response = $response->setStatusCode(500, 'Server Error!');
} finally {
    $response->emit();
}

