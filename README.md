### Hexlet tests and linter status:
[![Actions Status](https://github.com/mekhdiars/php-oop-project-60/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/mekhdiars/php-oop-project-60/actions)

# Валидатор данных

## Структура

- Validator: Класс для работы с разными типами данных.
- ParentSchema: Базовый класс для всех валидаторов, обеспечивающий общие методы для наследования.
- StringSchema: Валидация строк, включая длину, наличие определенных символов и другие правила.
- NumberSchema: Валидация числовых данных, включая проверку диапазонов, целочисленности и т.д.
- ArraySchema: Валидация массивов, проверка на пустоту, длину и другие условия.

## Использование

### Cтроки

- required – непустое значение (not null) и любая непустая строка
- minLength – строка равна или длиннее указанного числа
- contains – строка содержит определённую подстроку

```php
<?php

$v = new \Hexlet\Validator\Validator();

$schema = $v->string();
// Каждый вызов возвращает новую схему,
// так как у нас может быть любое количество независимых проверок
$schema2 = $v->string(); // $schema != $schema2

$schema->isValid(''); // true

// Null валидное значение для всех валидаторов
// если не задан required
$schema->isValid(null); // true

$schema->isValid('what does the fox say'); // true

$schema->required();

$schema2->isValid(''); // По прежнему валидно, это другая схема
$schema->isValid(null); // А тут не валидно
$schema->isValid(''); // И тут тоже

$schema->isValid('hexlet'); // true

$schema->contains('what')->isValid('what does the fox say'); // true
$schema->contains('whatthe')->isValid('what does the fox say'); // false

// Если один валидатор вызывался несколько раз
// то последний имеет приоритет (перетирает предыдущий)
$v->string()->minLength(10)->minLength(5)->isValid('Hexlet'); // true
```

### Числа

- required – непустое значение (not null) и любое число включая ноль
- positive – положительное число
- range – диапазон в который должны попадать числа включая границы

```php
<?php

$v = new \Hexlet\Validator\Validator();

$schema = $v->number();

$schema->isValid(null); // true

$schema->required();

$schema->isValid(null); // false

// Достаточно работать с типом Integer
$schema->isValid(7); // true

$schema->positive()->isValid(10); // true

$schema->range(-5, 5);

$schema->isValid(-3); // false
$schema->isValid(5); // true
```
