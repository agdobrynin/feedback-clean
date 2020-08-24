<?php

declare(strict_types=1);

namespace Core;


class Controller
{
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getCsrf(): Csrf
    {
        return $this->config->getCsrf();
    }

    public function getView(): View
    {
        return new View($this->config->getViewPath());
    }

    public function getPdo(): \PDO
    {
        return $this->config->pdo();
    }
}
