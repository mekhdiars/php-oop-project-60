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
        $require = true;
        $positive = true;

        if ($this->require) {
            $require = $num !== null;
        }
        if ($this->positive) {
            $positive = $num >= 0;
        }

        return $positive
            && $require
            && (int) $num >= $this->min
            && (int) $num <= $this->max;
    }
    
    public function required()
    {
        $this->require = true;
        return $this;
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
