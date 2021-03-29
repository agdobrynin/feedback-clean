<?php

declare(strict_types=1);

namespace Core;

final class EntityManager
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function add(EntityInterface $entity): void
    {
        $table = $entity->getTableName();
        $fields = implode(', ', $entity->getFields());
        $placeholders = implode(', ', $entity->getPlaceholders());
        $sql = sprintf('INSERT INTO %s (%s) VALUES(%s)', $table, $fields, $placeholders);
        $stm = $this->pdo->prepare($sql);
        $stmData = $entity->getPlaceholdersWithValues();
        $stm->execute($stmData);
    }
}
