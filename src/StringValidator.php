<?php

namespace Hexlet\Validator;

class StringValidator extends ParentValidator
{
    private string $substr = '';
    private int $minLength = 0;
    private static array $rules = [];
    private string $activeRule = '';
    private string $char = '';

    public function isValid(?string $text): bool
    {
        return $this->checkRequirement($text)
            && $this->checkContains($text)
            && $this->lengthCheck($text)
            && $this->ruleCheck($text);
    }

    public function contains(string $word): self
    {
        $this->substr = $word;
        return $this;
    }

    public function minLength(int $length): self
    {
        $this->minLength = $length;
        return $this;
    }

    public static function addRule(string $name, callable $fn): void
    {
        self::$rules[$name] = $fn;
    }

    public function test(string $name, string $char): self
    {
        $this->activeRule = $name;
        $this->char = $char;
        return $this;
    }

    public function checkRequirement(?string $text): bool
    {
        if (!$this->requirement) {
            return true;
        }

        return !empty($text);
    }

    public function checkContains(?string $text): bool
    {
        return str_contains($text, $this->substr) || is_null($text);
    }

    public function lengthCheck(?string $text): bool
    {
        if ($this->minLength === 0) {
            return true;
        }

        return strlen($text) >= $this->minLength;
    }

    public function ruleCheck(?string $text): bool
    {
        $fn = self::$rules[$this->activeRule] ?? null;

        if (is_null($fn)) {
            return true;
        }

        return $fn($text, $this->char);
    }
}
