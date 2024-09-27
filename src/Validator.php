<?php

namespace Hexlet\Validator;

class Validator
{
    private array $validators = [
        'string' => StringValidator::class,
        'number' => NumberValidator::class,
        'array' => ArrayValidator::class
    ];

    public function string(): StringValidator
    {
        return new StringValidator();
    }

    public function number(): NumberValidator
    {
        return new NumberValidator();
    }

    public function array(): ArrayValidator
    {
        return new ArrayValidator();
    }

    public function addValidator(string $type, string $name, callable $fn): void
    {
        $className = $this->validators[$type];
        $className::addRule($name, $fn);
    }
}
