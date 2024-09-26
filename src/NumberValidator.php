<?php

namespace Hexlet\Validator;

class NumberValidator extends ParentValidator
{
    private bool $shouldBePositive = false;
    private $min = -INF;
    private $max = INF;

    public function isValid(?int $num): bool
    {
        return $this->checkRequirement($num)
            && $this->checkPositive($num)
            && (int) $num >= $this->min
            && (int) $num <= $this->max;
    }

    public function positive(): self
    {
        $this->shouldBePositive = true;
        return $this;
    }

    public function range($min, $max): void
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function checkRequirement(?int $num): bool
    {
        if (!$this->requirement) {
            return true;
        }

        return is_integer($num);
    }

    public function checkPositive(?int $num): bool
    {
        if (!$this->shouldBePositive) {
            return true;
        }

        return $num > 0 || is_null($num);
    }

}
