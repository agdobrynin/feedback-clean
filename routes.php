<?php

declare(strict_types=1);

use Core\{Config, Response, View};

return [
    '/' => static function(Config $config): Response {
        $response = new Response();
        // Выставить в header csrf токен для защиты формы.
        $data['csrf'] = $config->getCsrf()->refresh($response);
        $body = (new View($config->getViewPath()))->render('index', $data);

        return $response->setBody($body);
    },
    '/store' => App\Controller\SaveFeedback::class,
];
