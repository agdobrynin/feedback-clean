<?php

declare(strict_types=1);

namespace App\Collection;

use App\Entity\Message;

final class Messages
{
    public const PAGE_SIZE = 5;
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getTotal(): int
    {
        return (int)$this->pdo->query('SELECT count(id) FROM Messages')->fetchColumn();
    }

    public function getOnPage(int $page): \Iterator
    {
        $offset = (($page > 1 ? $page : 1) - 1) * self::PAGE_SIZE;
        $sql = sprintf('SELECT * FROM %s ORDER BY createdAt DESC LIMIT %d OFFSET %d', Message::TABLE, self::PAGE_SIZE, $offset);
        $stm = $this->pdo->query($sql);
        $stm->setFetchMode(\PDO::FETCH_CLASS| \PDO::FETCH_PROPS_LATE, Message::class);
        while ($record = $stm->fetch()) {
            yield $record;
        }
    }
}