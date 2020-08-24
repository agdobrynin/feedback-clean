<?php

declare(strict_types=1);

namespace App\Entity;

final class Message
{
    private $name;
    private $email;
    private $message;

    public function __construct(array $input)
    {
        $data = array_values(filter_var_array($input, [
            'name' => FILTER_SANITIZE_STRING,
            'email' => FILTER_VALIDATE_EMAIL,
            'message' => FILTER_SANITIZE_STRING,
        ]));
        [$this->name, $this->email, $this->message] = array_map('trim'  , $data);
    }

    public function getSql(): string
    {
        return 'INSERT INTO Messages (name, email, message, createdAt) VALUES (:name, :email, :message, :createdAt)';
    }

    public function getStmData(): array
    {
        return [
            ':name' => $this->name,
            ':email' => $this->email,
            ':message' => $this->message,
            ':createdAt' => time(),
        ];
    }

    public function validate(): self
    {
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }
}