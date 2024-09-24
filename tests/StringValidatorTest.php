<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class StringValidatorTest extends TestCase
{
    private $v;

    public function setUp(): void
    {
        $this->v = new Validator();
    }

    public function testString(): void
    {
        $schema = $this->v->string();
        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));
    }

    public function testRequired(): void
    {
        $schema = $this->v->string();
        $schema->required();
        $this->assertFalse($schema->isValid(''));
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));
    }

    public function testContains(): void
    {
        $schema = $this->v->string();
        $schema->required();
        $result1 = $schema->contains('what')->isValid('what does the fox say');
        $result2 = $schema->contains('whatthe')->isValid('what does the fox say');
        $this->assertTrue($result1);
        $this->assertFalse($result2);
    }

    public function testLength()
    {
        $schema = $this->v->string();
        $schema->required();
        $result1 = $schema->minLength(10)->minLength(5)->isValid('Hexlet');
        $result2 = $schema->minLength(10)->minLength(5)->isValid('one');
        $this->assertTrue($result1);
        $this->assertFalse($result2);
    }
}
