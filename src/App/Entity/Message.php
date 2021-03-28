<?php

declare(strict_types=1);

namespace App\Entity;

use Core\Entity;

final class Message extends Entity
{
    public const TABLE = 'Messages';

    private $id;

    public $name;
    public $email;
    public $message;
    public $createdAt;

    public static function createFromPostAndValidate(array $input = []): self
    {
        $data = array_values(filter_var_array($input, [
            'name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'message' => FILTER_SANITIZE_STRING,
        ]));

        [$name, $email, $message] = array_map('trim'  , $data);

        if (empty($name)) {
            throw new \UnexpectedValueException('Поле "Имя" обязательное для заполнения');
        }
        if (empty($email)) {
            throw new \UnexpectedValueException('Email является некорректным');
        }
        if (empty($message)) {
            throw new \UnexpectedValueException('Поле "Сообщение" обязательное для заполнения');
        }

        $msg = new self();
        $msg->name = $name;
        $msg->email = $email;
        $msg->message = $message;
        $msg->createdAt = time();

        return $msg;
    }

    public function getTableName(): string
    {
        return self::TABLE;
    }

    public function getPrimaryKeyName(): string
    {
        return 'id';
    }
}
