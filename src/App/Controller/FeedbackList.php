<?php

declare(strict_types=1);

namespace App\Controller;

use App\Collection\Messages;
use App\Entity\Message;
use Core\{Controller, Response};

final class FeedbackList extends Controller
{
    public function __invoke(): Response
    {
        $response = new Response();
        try {
            // Выдать новый Csrf токен
            $data['csrf'] = $this->getCsrf()->refresh($response);
            // Работа с коллекцией сообщений
            $messageCollection = new Messages($this->getPdo());
            $data['pages'] = ceil($messageCollection->getTotal() / Messages::PAGE_SIZE);
            $result = $this->getView()->render('list', $data);
        } catch (\Throwable | \PDOException $exception) {
            $response->setStatusCode(500, 'Server Error!');
            $result = $exception->getMessage();
        }

        return $response->setBody($result);
    }
}
