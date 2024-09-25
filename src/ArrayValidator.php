<?php

namespace Hexlet\Validator;

class ArrayValidator
{
    private $require;
    private $size;

    public function __construct()
    {
        $this->require = false;
        $this->size = false;
    }

    public function isValid($arr)
    {
        $sizeof = true;

        if (!$this->require) {
            return true;
        }
        if ($this->size) {
            $sizeof = count($arr) === $this->size;
        }

        return is_array($arr) && $sizeof;
    }

    public function required()
    {
        $this->require = true;
    }

    public function sizeof($num)
    {
        $this->size = $num;
    }
}
