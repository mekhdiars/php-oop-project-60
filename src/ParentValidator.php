<?php

namespace Hexlet\Validator;

abstract class ParentValidator
{
    protected bool $requirement = false;

    public function required(): static
    {
        $this->requirement = true;
        return $this;
    }
}
