<?php

namespace Hexlet\Validator\Tests;

use Hexlet\Validator\Validator;
use PHPUnit\Framework\TestCase;

class AddValidatorTest extends TestCase
{
    public function testString(): void
    {
        $v = new Validator();
        $fn = fn($value, $start) => str_starts_with($value, $start);
        $v->addValidator('string', 'startWith', $fn);
        $schema = $v->string()->test('startWith', 'H');
        $result1 = $schema->isValid('exlet');
        $result2 = $schema->isValid('Hexlet');
        $this->assertFalse($result1);
        $this->assertTrue($result2);
    }

    public function testNumber(): void
    {
        $v = new Validator();
        $fn = fn($value, $min) => $value >= $min;
        $v->addValidator('number', 'min', $fn);
        $schema = $v->number()->test('min', 5);
        $result1 = $schema->isValid(4);
        $result2 = $schema->isValid(6);
        $this->assertFalse($result1);
        $this->assertTrue($result2);
    }
}
