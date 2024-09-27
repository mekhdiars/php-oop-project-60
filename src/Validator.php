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
        return new StringValidator();
    }

    public function number(): NumberValidator
    {
        $className = $this->validators['number'];
        return new NumberValidator();
    }

    public function array(): ArrayValidator
    {
        $className = $this->validators['array'];
        return new ArrayValidator();
    }

    public function addValidator(string $type, string $name, callable $fn): void
    {
        $className = $this->validators[$type];
        $className::addRule($name, $fn);
    }
}
