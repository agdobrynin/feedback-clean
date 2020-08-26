<?php

declare(strict_types=1);

namespace Core;

final class Csrf
{
    public const CSRF_KEY = 'Csrf-Token';
    private const TTL = '+30min';

    public function getValue(): string
    {
        if (!isset($_SESSION[self::CSRF_KEY])) {
            $this->setToken();
        }
        return $_SESSION[self::CSRF_KEY]['val'];
    }

    public function getTtl(): int
    {
        return $_SESSION[self::CSRF_KEY]['ttl'];
    }

    public function verify(): self
    {
        $input = filter_input(\INPUT_POST, self::CSRF_KEY, FILTER_SANITIZE_SPECIAL_CHARS);
        if ($input !== $this->getValue()) {
            throw new \UnexpectedValueException('Csrf token unavailable');
        }
        if ($this->getTtl() < time()) {
            $message = sprintf('Csrf token was expired ttl. Config for TTL of Csrf = "%s"', self::TTL);
            throw new \UnexpectedValueException($message);
        }

        return $this;
    }

    public function setToken(Response $response): self
    {
        $csrf = $this->generate();
        $_SESSION[self::CSRF_KEY] = ['val' => $csrf, 'ttl' => strtotime(self::TTL)];
        $response->setHeader(self::CSRF_KEY, $csrf);

        return $this;
    }

    public function getCsrfFiled(): string
    {
        return sprintf('<input type="hidden" name="%s" value="%s">', self::CSRF_KEY, $this->getValue());
    }

    private function generate(): string
    {
        return uniqid('', true);
    }
}