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
        $className = $this->validators['string'];
        return new $className();
    }

    public function number(): NumberValidator
    {
        $className = $this->validators['number'];
        return new $className();
    }

    public function array(): ArrayValidator
    {
        $className = $this->validators['array'];
        return new $className();
    }

    public function addValidator(string $type, string $name, callable $fn): void
    {
        $className = $this->validators[$type];
        $className::addRule($name, $fn);
    }
}
