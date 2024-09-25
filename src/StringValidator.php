<?php

namespace Hexlet\Validator;

class StringValidator
{
    private $require;
    private $substr;
    private $minLength;

    public function __construct()
    {
        $this->require = false;
        $this->substr = '';
        $this->minLength = 0;
    }

    public function isValid($text)
    {
        if (!$this->require) {
            return true;
        }

        return !empty($text)
            && str_contains($text, $this->substr)
            && strlen($text) >= $this->minLength;
    }

    public function required()
    {
        $this->require = true;
    }

    public function contains($word)
    {
        $this->substr = $word;
        return $this;
    }

    public function minLength($length)
    {
        $this->minLength = $length;
        return $this;
    }
}
