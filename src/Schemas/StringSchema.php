<?php

namespace Hexlet\Validator\Schemas;

use function Symfony\Component\String\u;

class StringSchema extends ParentSchema
{
    private string $substr = '';
    private int|null $minLength = null;
    private static array $rules = [];
    private string $activeRule = '';
    private string $char = '';

    public function isValid(?string $text): bool
    {
        return $this->isTextValid($text)
            && $this->hasRequiredSubstr($text)
            && $this->hasRequiredLength($text)
            && $this->isAccordingRule($text);
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

    public function isTextValid(?string $text): bool
    {
        if (!$this->requirement) {
            return true;
        }

        return $text !== '' && $text !== null;
    }

    public function hasRequiredSubstr(?string $text): bool
    {
        if ($this->substr === '') {
            return true;
        }

        return u($text)->containsAny($this->substr);
    }

    public function hasRequiredLength(?string $text): bool
    {
        if ($this->minLength === null) {
            return true;
        }

        return u($text)->length() >= $this->minLength;
    }

    public function isAccordingRule(?string $text): bool
    {
        $fn = self::$rules[$this->activeRule] ?? null;

        if (is_null($fn)) {
            return true;
        }

        return $fn($text, $this->char);
    }
}
