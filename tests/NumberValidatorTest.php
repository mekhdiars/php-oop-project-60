<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class NumberValidatorTest extends TestCase
{
    public $v;

    public function setUp(): void
    {
        $this->v = new Validator;
    }

    public function testNumber(): void
    {
        $schema = $this->v->number();
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid(10));
    }

    public function testRequired(): void
    {
        $schema = $this->v->number();
        $schema->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(10));
    }

    public function testPositive(): void
    {
        $schema = $this->v->number();
        $schema->required();
        $schema->positive();
        $this->assertFalse($schema->isValid(-10));
        $this->assertTrue($schema->isValid(10));
    }

    public function testRange(): void
    {
        $schema = $this->v->number();
        $schema->required();
        $schema->positive();
        $schema->range(-5, 5);
        $this->assertFalse($schema->isValid(-1));
        $this->assertTrue($schema->isValid(5));
    }
}
