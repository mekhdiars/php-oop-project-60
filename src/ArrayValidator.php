<?php

namespace Hexlet\Validator;

class ArrayValidator
{
    private $require;
    private $size;
    private $shape;

    public function __construct()
    {
        $this->require = false;
        $this->size = false;
        $this->shape = [];
    }

    public function isValid($arr)
    {
        $sizeof = true;
        $shape = true;

        if (!$this->require) {
            return true;
        }
        if ($this->size) {
            $sizeof = count($arr) === $this->size;
        }
        if (!empty($this->shape)) {
            $nameSchema = $this->shape['name'];
            $ageSchema = $this->shape['age'];
            $shape = $nameSchema->isValid($arr['name']) && $ageSchema->isValid($arr['age']);
            // dump($shape);
        }

        return is_array($arr)
            && $sizeof
            && $shape;
    }

    public function required()
    {
        $this->require = true;
    }

    public function sizeof($num)
    {
        $this->size = $num;
        return true;
    }

    public function shape($arr)
    {
        $this->shape = $arr;
        $this->require = true;
    }
}
