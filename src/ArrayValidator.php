<?php

namespace Hexlet\Validator;

class ArrayValidator extends ParentValidator
{
    private int|null $size = null;
    private array $shape = [];

    public function isValid(?array $arr): bool
    {
        return $this->checkRequirement($arr)
            && $this->checkSizeof($arr)
            && $this->checkShape($arr);
    }

    public function sizeof(int $num): bool
    {
        $this->size = $num;
        return true;
    }

    public function shape(array $arr): void
    {
        $this->shape = $arr;
        $this->requirement = true;
    }

    public function checkRequirement(?array $arr): bool
    {
        if (!$this->requirement) {
            return true;
        }

        return is_array($arr);
    }

    public function checkSizeof(?array $arr): bool
    {
        if (is_null($this->size)) {
            return true;
        }

        return collect($arr)->count() === $this->size;
    }

    public function checkShape(?array $arr): bool
    {
        if ($this->shape === []) {
            return true;
        }

        $name = $arr['name'] ?? null;
        $age = $arr['age'] ?? null;
        $nameSchema = $this->shape['name'];
        $ageSchema = $this->shape['age'];

        return $nameSchema->isValid($name)
            && $ageSchema->isValid($age);
    }
}
