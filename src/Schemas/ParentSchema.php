<?php

namespace Hexlet\Validator\Schemas;

abstract class ParentSchema
{
    protected bool $requirement = false;

    public function required(): static
    {
        $this->requirement = true;
        return $this;
    }
}
