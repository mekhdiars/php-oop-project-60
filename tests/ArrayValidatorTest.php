<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ArrayValidatorTest extends TestCase
{
    private $v;

    public function setUp(): void
    {
        $this->v = new Validator();
    }

    public function testArray(): void
    {
        $schema = $this->v->array();
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['one']));
    }

    public function testRequire(): void
    {
        $schema = $this->v->array();
        $schema->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['one']));
    }

    public function testSizeof(): void
    {
        $schema = $this->v->array();
        $schema->required();
        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['one']));
        $this->assertTrue($schema->isValid(['one', 'zero']));
    }
}