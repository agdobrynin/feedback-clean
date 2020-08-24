<?php

declare(strict_types=1);

use Core\Csrf;

return [
    'db' => [
        'dsn' => 'sqlite:'. __DIR__ .DIRECTORY_SEPARATOR.'store'.DIRECTORY_SEPARATOR.'sqlite.db',
        'user' => null,
        'password' => null,
    ],
    'view' => __DIR__.DIRECTORY_SEPARATOR.'view',
    // Защита форм
    'csrf' => new Csrf(),
];