<?php

declare(strict_types=1);

namespace Core;

final class Response
{
    private $statusCode = 200;
    private $responsePhrase = 'OK';
    private $body = '';
    private $headers = [];

    public function setStatusCode(int $statusCode, string $responsePhrase = 'OK'): self
    {
        $this->statusCode = $statusCode;
        $this->responsePhrase = $responsePhrase;

        return $this;
    }

    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function setJson(array $data): self
    {
        try {
            $this->setHeader('Content-type', 'application/json; charset=utf-8');
            $response = json_encode($data, JSON_THROW_ON_ERROR);
        } catch (\JsonException $exception) {
            $this->setStatusCode(500, 'Json decode error');
            $response = $exception->getMessage();
        }
        $this->setBody($response);

        return $this;
    }

    public function emit(): void
    {
        $protocol = $_SERVER['SERVER_PROTOCOL'] ?? 'HTTP';
        $header = sprintf('%s/1.1 %s %s', $protocol, $this->statusCode, $this->responsePhrase);
        header($header);
        foreach ($this->headers as $name => $value) {
            $header = sprintf('%s: %s', $name, $value);
            header($header);
        }

        print $this->body;
    }
}
