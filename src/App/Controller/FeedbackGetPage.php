<?php

declare(strict_types=1);

namespace App\Controller;

use App\Collection\Messages as MessageCollection;
use App\Entity\Message;
use Core\{Controller, ControllerInterface, Response};

final class FeedbackGetPage extends Controller implements ControllerInterface
{
    public function __invoke(): Response
    {
        // Выдать новый Csrf токен
        $this->config->getCsrf()->verify()->setToken($this->response);

        // Работа с коллекцией сообщений
        $messageCollection = new MessageCollection($this->config->pdo());
        $page = (int)filter_input(\INPUT_POST, 'page', FILTER_VALIDATE_INT);
        $messages = [];

        foreach ($messageCollection->getOnPage($page) as $message) {
            /** @var $message Message */
            $message->createdAt = (new \DateTime())->setTimestamp((int)$message->createdAt)
                ->format('g:ia \o\n l jS F Y');
            $messages[] = $message;
        }

        return $this->response->setJson(['messages' => $messages]);
    }
}
