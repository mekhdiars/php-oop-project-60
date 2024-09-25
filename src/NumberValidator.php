<?php

namespace Hexlet\Validator;

class NumberValidator
{
    private $require;
    private $positive;
    private $min;
    private $max;

    public function __construct()
    {
        $this->require = false;
        $this->positive = false;
        $this->min = -INF;
        $this->max = INF;
    }

    public function isValid($num)
    {
        $positive = true;

        if (!$this->require) {
            return true;
        }
        if ($this->positive) {
            $positive = $num > 0;
        }

        return $positive
            && $num >= $this->min
            && $num <= $this->max;
    }
    
    public function required()
    {
        $this->require = true;
    }

    public function positive()
    {
        $this->positive = true;
        return $this;
    }

    public function range($min, $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
}
