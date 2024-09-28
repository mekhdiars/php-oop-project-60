<?php

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\ArraySchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;

class Validator
{
//    private array $schemas = [
//        'string' => StringSchema::class,
//        'number' => NumberSchema::class,
//        'array' => ArraySchema::class
//    ];
    private array $customValidators = [];

    public function string(): StringSchema
    {
        $schema = new StringSchema();
        $schema->addRules($this->customValidators['string'] ?? []);

        return $schema;
    }

    public function number(): NumberSchema
    {
        return new NumberSchema();
    }

    public function array(): ArraySchema
    {
        return new ArraySchema();
    }

    public function addValidator(string $type, string $name, callable $fn): void
    {
        $this->customValidators[$type][$name] = $fn;
    }
}
