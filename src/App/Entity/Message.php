<?php

declare(strict_types=1);

namespace App\Entity;

final class Message
{
    public const TABLE = 'Messages';

    private $id;
    private $name;
    private $email;
    private $message;
    private $createdAt;

    public function __construct(array $input = [])
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
        return sprintf('INSERT INTO %s (name, email, message, createdAt) VALUES (:name, :email, :message, :createdAt)', self::TABLE);
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

    public function getId():?int
    {
        return (int)$this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return (new \DateTimeImmutable())->setTimestamp((int)$this->createdAt);
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'message' => $this->getMessage(),
            'createdAt' => $this->getCreatedAt()->format('d.m.Y H:i.s'),
        ];
    }
}