<?php

declare(strict_types=1);

namespace Core;

abstract class Entity implements EntityInterface
{
    protected $reflection;
    private $fieldsWithPlaceholders;

    public function __construct()
    {
        $this->reflection = new \ReflectionClass($this);
        foreach ($this->reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $this->fieldsWithPlaceholders[$property->getName()] = ':'.$property->getName();
        }
    }

    public function getFields(): array
    {
        return array_keys($this->fieldsWithPlaceholders);
    }

    public function getPlaceholders(): array
    {
        return array_values($this->fieldsWithPlaceholders);
    }

    public function getPlaceholdersWithValues(): array
    {
        $val = [];
        foreach ($this->fieldsWithPlaceholders as $field => $placeholder) {
            $val[$placeholder] = $this->{$field};
        }

        return $val;
    }
}
