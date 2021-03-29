<?php

declare(strict_types=1);

namespace Core;


abstract class Controller implements ControllerInterface
{
    protected $config;
    protected $response;

    public function __construct(Config $config, Response $response)
    {
        $this->config = $config;
        $this->response = $response;
    }

    public function getView(): View
    {
        return new View($this->config->getViewPath());
    }
}
