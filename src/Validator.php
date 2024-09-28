<?php

namespace Hexlet\Validator;

use Hexlet\Validator\Schemas\ArraySchema;
use Hexlet\Validator\Schemas\NumberSchema;
use Hexlet\Validator\Schemas\StringSchema;

class Validator
{
    private array $validators = [
        'string' => StringSchema::class,
        'number' => NumberSchema::class,
        'array' => ArraySchema::class
    ];

    public function string(): StringSchema
    {
        return new StringSchema();
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
        $className = $this->validators[$type];
        $className::addRule($name, $fn);
    }
}
