<?php

declare(strict_types=1);

namespace Core;

final class Router
{
    private $routes;
    private $uri;
    private $config;

    public function __construct(Config $config)
    {
        $this->routes = [];
        $this->uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->config = $config;
    }
    public function add(string $route, $callable): self
    {
        $this->routes[$route] = $callable;

        return $this;
    }

    public function execute(): Response
    {
        $action = $this->routes[$this->uri] ?? null;
        if ($action) {
            if (is_string($action)) {
                return call_user_func(new $action($this->config));
            }

            if (is_callable($action)) {
                return $action($this->config);
            }
        }

        throw new \InvalidArgumentException(sprintf('Route "%s" not declare', $this->uri));
    }
}
