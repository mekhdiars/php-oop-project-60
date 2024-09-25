<?php

namespace Hexlet\Validator;

class Validator
{
    public function string()
    {
        return new StringValidator();
    }

    public function number()
    {
        return new NumberValidator();
    }

    public function array()
    {
        return new ArrayValidator();
    }
}