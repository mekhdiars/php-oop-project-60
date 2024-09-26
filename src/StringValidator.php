<?php

namespace Hexlet\Validator;

class StringValidator extends ParentValidator
{
    private string $substr = '';
    private int $minLength = 0;

    public function isValid(?string $text): bool
    {
        if (!$this->requirement) {
            return true;
        }

        return !empty($text)
            && str_contains($text, $this->substr)
            && strlen($text) >= $this->minLength;
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
}
