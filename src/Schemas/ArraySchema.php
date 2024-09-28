<?php

namespace Hexlet\Validator\Schemas;

class ArraySchema extends ParentSchema
{
    public function required(): self
    {
        $this->rules['required'] = fn($arr) => is_array($arr);
        return $this;
    }

    public function sizeof(int $size): self
    {
        $this->rules['sizeof'] = fn($arr) => count($arr) === $size;
        return $this;
    }

    public function shape(array $shape): self
    {
        $func = function ($arr) use ($shape) {
            foreach ($shape as $key => $schema) {
                $value = $arr[$key] ?? null;

                if (!$schema->isValid($value)) {
                    return false;
                }
            }

            return true;
        };

        $this->rules['shape'] = $func;
        return $this;
    }
}
