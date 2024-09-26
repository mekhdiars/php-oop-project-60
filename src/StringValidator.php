<?php

namespace Hexlet\Validator;

class StringValidator extends ParentValidator
{
    private string $substr = '';
    private int $minLength = 0;

    public function isValid(?string $text): bool
    {
        return $this->checkRequirement($text)
            && $this->checkContains($text)
            && $this->checkLength($text);
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

    public function checkLength(?string $text): bool
    {
        if ($this->minLength === 0) {
            return true;
        }

        return strlen($text) >= $this->minLength;
    }
}
