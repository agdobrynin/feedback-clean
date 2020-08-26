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
        // Выдать новый Csrf токен
        $data['csrf'] = $this->getCsrf()->setToken($response);
        // Работа с коллекцией сообщений
        $messageCollection = new Messages($this->getPdo());
        $data['pages'] = ceil($messageCollection->getTotal() / Messages::PAGE_SIZE);

        return $response->setBody($this->getView()->render('list', $data));
    }
}
