<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class ArrayValidatorTest extends TestCase
{
    private Validator $v;

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

    public function testShape(): void
    {
        $v = $this->v;
        $schema = $v->array();
        $schema->shape([
            'name' => $v->string()->required(),
            'age' => $v->number()->positive(),
        ]);

        $result1 = $schema->isValid(['name' => 'kolya', 'age' => 100]);
        $result2 = $schema->isValid(['name' => 'maya', 'age' => null]);
        $result3 = $schema->isValid(['name' => '', 'age' => null]);
        $result4 = $schema->isValid(['name' => 'ada', 'age' => -5]);
        $this->assertTrue($result1);
        $this->assertTrue($result2);
        $this->assertFalse($result3);
        $this->assertFalse($result4);
    }
}
