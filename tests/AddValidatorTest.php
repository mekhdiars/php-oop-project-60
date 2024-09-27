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
}
