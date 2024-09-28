<?php

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\ArraySchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;

class Validator
{
    private array $customValidators = [];

    public function string(): StringSchema
    {
        $schema = new StringSchema();
        $schema->addRules($this->customValidators['string'] ?? []);

        return $schema;
    }

    public function number(): NumberSchema
    {
        $schema = new NumberSchema();
        $schema->addRules($this->customValidators['number'] ?? []);

        return $schema;
    }

    public function array(): ArraySchema
    {
        $schema = new ArraySchema();
        $schema->addRules($this->customValidators['array'] ?? []);

        return $schema;
    }

    public function addValidator(string $type, string $name, callable $fn): void
    {
        $this->customValidators[$type][$name] = $fn;
    }
}
