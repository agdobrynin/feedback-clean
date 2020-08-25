<?php

declare(strict_types=1);

namespace App\Controller;

use App\Collection\Messages;
use App\Entity\Message;
use Core\{Controller, Response};

class FeedbackGetPage extends Controller
{
    public function __invoke(): Response
    {
        $response = new Response();
        // Выдать новый Csrf токен
        $this->getCsrf()->verify()->refresh($response);
        // Работа с коллекцией сообщений
        $messageCollection = new Messages($this->getPdo());
        $page = (int)filter_input(\INPUT_POST, 'page', FILTER_VALIDATE_INT);
        $messages = [];
        foreach ($messageCollection->getOnPage($page) as $message) {
            /** @var $message Message */
            $messages[] = $message->toArray();
        }

        return $response->setJson(['messages' => $messages]);
    }
}