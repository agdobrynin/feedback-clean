<?php

declare(strict_types=1);

$routes = require 'routes.php';
$router = new Core\Router(new Core\Config(require 'config.php'));

foreach ($routes as $uri => $action) {
    $router->add($uri, $action);
}

return $router;
