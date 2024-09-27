<?php

namespace Hexlet\Validator;

class NumberValidator extends ParentValidator
{
    private bool $shouldBePositive = false;
    private float|int $min = -INF;
    private float|int $max = INF;
    private static array $rules = [];
    private string $activeRule = '';
    private int $num;

    public function isValid(?int $num): bool
    {
        return $this->checkRequirement($num)
            && $this->checkPositive($num)
            && $this->ruleCheck($num)
            && (int) $num >= $this->min
            && (int) $num <= $this->max;
    }

    public function positive(): self
    {
        $this->shouldBePositive = true;
        return $this;
    }

    public function range(int $min, int $max): self
    {
        $this->min = $min;
        $this->max = $max;
        return $this;
    }

    public static function addRule(string $name, callable $fn): void
    {
        self::$rules[$name] = $fn;
    }

    public function test(string $functionName, int $num): self
    {
        $this->activeRule = $functionName;
        $this->num = $num;
        return $this;
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

    public function ruleCheck(?int $num): bool
    {
        $fn = self::$rules[$this->activeRule] ?? null;

        if (is_null($fn)) {
            return true;
        }

        return $fn($num, $this->num);
    }
}
