<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use Core\{Controller, Response};


final class FeedbackSave extends Controller
{
    public function __invoke(): Response
    {
        $response = new Response();
        try {
            // проверми csrf ключ и выставим новый если все ок
            $this->getCsrf()->verify()->refresh($response);
            // Создаю Entity и валидирую данные с POST
            $message = (new Message($_POST))->validate();
            $stm = $this->getPdo()->prepare($message->getSql());
            $stm->execute($message->getStmData());
            $data = ['success' => sprintf('Спасибо, %s', $message->getName())];
            $response->setStatusCode(200);
        } catch (\UnexpectedValueException | \PDOException $exception) {
            $data = ['error' => $exception->getMessage()];
            $response->setStatusCode(500, 'Server error');
        }

        return $response->setJson($data);
    }
}