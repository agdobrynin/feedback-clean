<?php

declare(strict_types=1);

namespace Core;


interface ControllerInterface
{
    public function __invoke(): Response;
}
