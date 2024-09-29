<?php

namespace Hexlet\Validator\Schemas;

abstract class ParentSchema
{
    protected array $rules = [];
    private array $customRules = [];
    private string $nameOfActiveRule = '';
    private mixed $valueForActiveRule;

    public function isValid(mixed $data): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule($data)) {
                return false;
            }
        }

        $fn = $this->customRules[$this->nameOfActiveRule] ?? null;
        if ($fn === null) {
            return true;
        }
        if (!$fn($data, $this->valueForActiveRule)) {
            return false;
        }

        return true;
    }

    public function addRules(array $rules): void
    {
        $this->customRules = $rules;
    }

    public function test(string $funcName, string $value): self
    {
        $this->nameOfActiveRule = $funcName;
        $this->valueForActiveRule = $value;
        return $this;
    }
}
