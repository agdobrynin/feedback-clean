<?php
declare(strict_types=1);
spl_autoload_register(static function ($class) {
    require_once __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
});
