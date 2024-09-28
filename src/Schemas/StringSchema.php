<?php

namespace Hexlet\Validator\Schemas;

use function Symfony\Component\String\u;

class StringSchema extends ParentSchema
{
    public function required(): static
    {
        $this->rules['required'] = fn($text) => $text !== '' && $text !== null;
        return $this;
    }

    public function contains(string $substr): self
    {
        $this->rules['contains'] = fn($text) => u($text)->containsAny($substr);
        return $this;
    }

    public function minLength(int $length): self
    {
        $this->rules['minLength'] = fn($text) => u($text)->length() >= $length;
        return $this;
    }
}
