# Php8forPhp7 - Помощник проверки составных типов
[<<< Оглавление](README.md)

Одной из сильных сторон PHP 8 является поддержка DNF (Disjunctive Normal Form) типов данных позволяющих определять
свойства классов, аргументы функций и возвращаемые значения, как составные типы данных, [подробнее о составных типах
в документации по PHP](https://www.php.net/manual/ru/language.types.declarations.php#language.types.declarations.composite)

В PHP7 составных типов не существует, Но, обычно в DocBlock прописываются аннотации на составные типы. Функционал
Php8forPhp7 библиотеки предоставляет простой способ проверки таких типов данных - `\DraculAid\Php8forPhp7\TypeValidator`

По умолчанию, в случае провала проверки, методы валидатора выбросят `\TypeError` (стандартная PHP ошибка типов данных),
но также методы могут вернуть `TRUE или FALSE`

## Примеры валидации

### Перечисление типов

Для случаев, когда переменная может иметь один из перечисленных типов

```php
// Класс для валидации
use \DraculAid\Php8forPhp7\TypeValidator;

/**
* @param string|array $a
* @return string
 */
public function f($a): string
{
    /** Если аргумент функции $a будет не строкой или массивом - будет выброшено TypeError */
    TypeValidator::validateOr($a, ['string', 'array']);
    
    echo "OK";
}

// это вызов функции будет корректным
f('123');

// этот вызов закончится выброшенным TypeError
try {
    f(123);
} catch (\TypeError $error) {
    echo "FAIL";
}

// если в случае провала проверки нужно вернуть FALSE (в случае успеха вернет TRUE)
TypeValidator::validateOr($a, ['string', 'array'], false);
```

### Пересечение типов

Для случаев, когда переменная должна соответствовать всем перечисленным типам (имеет смысл только для объектов, к примеру,
для проверок, соответствуют ли они нужным интерфейсам)

```php
// Класс для валидации
use \DraculAid\Php8forPhp7\TypeValidator;

$a = new \Exception();

// эта проверка будет успешной
TypeValidator::validateOr($a, [\Exception::class, \Throwable::class]);

// эта проверка закончится выброшенным TypeError
TypeValidator::validateOr($a, [\Exception::class, \IteratorAggregate::class]);

// Эта првоерка вернет FALSE
TypeValidator::validateOr($a, [\Exception::class, \IteratorAggregate::class], false);
```

---

[<<< Оглавление](README.md)
