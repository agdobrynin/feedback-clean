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

    public function createFromPostAndValidate(array $input = []): self
    {
        $data = array_values(filter_var_array($input, [
            'name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'message' => FILTER_SANITIZE_STRING,
        ]));

        [$this->name, $this->email, $this->message] = array_map('trim'  , $data);
        $this->createdAt = time();

        if (empty($this->name)) {
            throw new \UnexpectedValueException('Поле "Имя" обязательное для заполнения');
        }
        if (empty($this->email)) {
            throw new \UnexpectedValueException('Email является некорректным');
        }
        if (empty($this->message)) {
            throw new \UnexpectedValueException('Поле "Сообщение" обязатльное для заполнения');
        }

        return $this;
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
