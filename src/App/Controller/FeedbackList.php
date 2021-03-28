<?php

declare(strict_types=1);

namespace App\Controller;

use App\Collection\Messages as MessageCollection;
use Core\{Controller, ControllerInterface, Response};

final class FeedbackList extends Controller implements ControllerInterface
{
    public function __invoke(): Response
    {
        // Выдать новый Csrf токен
        $data['csrf'] = $this->config->getCsrf()->setToken($this->response);

        // Работа с коллекцией сообщений
        $messageCollection = new MessageCollection($this->config->pdo());
        $data['pages'] = ceil($messageCollection->getTotal() / MessageCollection::PAGE_SIZE);

        return $this->response->setBody($this->getView()->render('list', $data));
    }
}
