### Hexlet tests and linter status:
[![Actions Status](https://github.com/mekhdiars/php-oop-project-60/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/mekhdiars/php-oop-project-60/actions)

# Валидатор данных

## Структура

- Validator: Класс для работы с разными типами данных.
- ParentSchema: Базовый класс для всех валидаторов, обеспечивающий общие методы для наследования.
- StringSchema: Валидация строк, включая длину, наличие определенных символов и другие правила.
- NumberSchema: Валидация числовых данных, включая проверку диапазонов, целочисленности и т.д.
- ArraySchema: Валидация массивов, проверка на пустоту, длину и другие условия.

## Установка

Для установки зависимостей используется Composer:

```bash
composer install
```

## Использование

Пример использования:
```php
<?php

use Hexlet\Validator\Validator;

$v = new \Hexlet\Validator\Validator();

// строки
$schema = $v->string()->required();

$schema->isValid('what does the fox say'); // true
$schema->isValid(''); // false

// числа
$schema = $v->number()->required()->positive();

$schema->isValid(-10); // false
$schema->isValid(10); // true

// массив с поддержкой проверки структуры
$schema = $v->array()->sizeof(2)->shape([
    'name' => $v->string()->required(),
    'age' => $v->number()->positive(),
]);

$schema->isValid(['name' => 'kolya', 'age' => 100]); // true
$schema->isValid(['name' => '', 'age' => null]); // false

// Добавление нового валидатора
$fn = fn($value, $start) => str_starts_with($value, $start);
$v->addValidator('string', 'startWith', $fn);

$schema = $v->string()->test('startWith', 'H');

$schema->isValid('exlet'); // false
$schema->isValid('Hexlet'); // true
```

## Тестирование

Для запуска тестов используйте следующую команду:
```
make test
```

## Системные требования

* PHP 7.4 или выше
* Composer

