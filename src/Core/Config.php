<?php

declare(strict_types=1);

namespace Core;


final class Config
{
    private $config;
    private $pdo;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function pdo(): \PDO
    {
        if (!isset($this->pdo)) {
            $db = $this->config['db'];
            $this->pdo = new \PDO($db['dsn'], $db['user'], $db['password']);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }

        return $this->pdo;
    }

    public function getViewPath(): string
    {
        return $this->config['view'];
    }

    public function getCsrf(): Csrf
    {
        return $this->config['csrf'];
    }

}
