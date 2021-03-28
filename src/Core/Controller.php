<?php

declare(strict_types=1);

namespace Core;


abstract class Controller implements ControllerInterface
{
    protected $config;
    protected $response;

    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->response = new Response();
    }

    public function getView(): View
    {
        return new View($this->config->getViewPath());
    }
}
