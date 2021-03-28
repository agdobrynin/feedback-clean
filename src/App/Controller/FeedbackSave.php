<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Message;
use Core\{Controller, ControllerInterface, EntityManager, Response};


final class FeedbackSave extends Controller implements ControllerInterface
{
    public function __invoke(): Response
    {
        // проверим csrf ключ и выставим новый если все ок.
        $this->config->getCsrf()->verify()->setToken($this->response);
        // Создать Entity и проверить на корректность входных данных.
        $message = (new Message())->createFromPostAndValidate($_POST);

        $entityManager = new EntityManager($this->config->pdo());
        $entityManager->add($message);

        return $this->response->setJson(['success' => sprintf('Спасибо, %s', $message->name)]);
    }
}
