<?php

declare(strict_types=1);

namespace Core;

final class Router
{
    private $routes;
    private $uri;
    private $config;
    private $response;
    private $isAjax;

    public function __construct(Config $config, Response $response)
    {
        $this->routes = [];
        $this->uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $this->config = $config;
        $this->response = $response;
        $this->isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    public function add(string $route, $callable): self
    {
        $this->routes[$route] = $callable;

        return $this;
    }

    public function isAjax(): bool
    {
        return $this->isAjax;
    }

    public function execute(): Response
    {
        $action = $this->routes[$this->uri] ?? null;
        if ($action) {
            if (is_string($action)) {
                return call_user_func(new $action($this->config, $this->response));
            }

            if (is_callable($action)) {
                return $action($this->config);
            }
        }

        throw new \InvalidArgumentException(sprintf('Route "%s" not declare', $this->uri));
    }
}
