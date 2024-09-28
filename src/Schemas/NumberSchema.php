<?php

namespace Hexlet\Validator\Schemas;

class NumberSchema extends ParentSchema
{
    public function required(): self
    {
        $this->rules['required'] = fn($num) => is_integer($num);
        return $this;
    }

    public function positive(): self
    {
        $this->rules['positive'] = fn($num) => $num > 0 || is_null($num);
        return $this;
    }

    public function range(int $min, int $max): self
    {
        $this->rules['range'] = fn($num) => $num >= $min && $num <= $max;
        return $this;
    }
}
