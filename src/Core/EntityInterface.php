<?php

declare(strict_types=1);

namespace Core;


interface EntityInterface
{
    public function getFields(): array;

    public function getPlaceholders(): array;

    public function getPlaceholdersWithValues(): array;

    public function getTableName(): string;

    public function getPrimaryKeyName(): string;

    public function getPrimaryKeyValue();

    public function setPrimaryKeyValue($primaryKeyValue): void;
}
