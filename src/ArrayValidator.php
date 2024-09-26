<?php

namespace Hexlet\Validator;

class ArrayValidator extends ParentValidator
{
    private $size;
    private array $shape = [];

    public function isValid(?array $arr): bool
    {
        if (!$this->requirement) {
            return true;
        }

        return is_array($arr)
            && $this->checkSizeof($arr);
    }

    public function sizeof($num): bool
    {
        $this->size = $num;
        return true;
    }

    public function shape($arr): void
    {
        $this->shape = $arr;
        $this->requirement = true;
    }

    public function checkSizeof(?array $arr): bool
    {
        if ($this->size) {
            return count($arr) === $this->size;
        }

        return true;
    }

    public function checkShape(?array $arr): bool
    {
        if (empty($this->shape)) {
            return true;
        }

        $name = $arr['name'];
        $age = $arr['age'];
        $nameSchema = $this->shape['name'];
        $ageSchema = $this->shape['age'];

        return $nameSchema->isValid($name)
            && $ageSchema->isValid($age);
    }
}
