# Php8forPhp7 - Нюансы для функций
[<<< Оглавление](README.md)

Для подключения всех описанных в библиотеке функций достаточно подключить файл `src/functions.php`, при этом
будут объявлены функции PHP 8 (в глобальном пространстве имен) и "их копии" в пространстве имен `/DraculAid/Php8forPhp7`.
Если функции уже были определены ранее, при этом функции определенные в `/DraculAid/Php8forPhp7` будут доступны всегда

Также в каталоге `src/functions` можно найти определение всех функций по отдельности

**Подключение всех функций**
```php
// --- подключение всех функций с помощью агрузчика ---
DraculAid\Php8forPhp7\LoaderPhp8Lib::loadAllFunctions();

// * * *

// --- Подключение через вызова файла, сборщика кода функций ---

// путь до библиотеки
$pathPhp8forPhp7 = 'vendor/DraculAid/Php8forPhp7';
// подключение класса
require_once($pathPhp8forPhp7 . '/src/functions.php');
```

**Подключение только array_is_list() и `/DraculAid/Php8forPhp7/array_is_list()`**
```php
// подключение с помощью загрузчика
DraculAid\Php8forPhp7\LoaderPhp8Lib::loadFunction('array_is_list');

// * * *

// --- Подключение файла с кодом функции ---

// путь до библиотеки
$pathPhp8forPhp7 = 'vendor/DraculAid/Php8forPhp7';
// подключение класса
require_once($pathPhp8forPhp7 . '/src/functions/array_is_list.php');
```

## enum_exists()

> enum_exists() Проверяет, было ли загружено перечисление, и если надо, вызовет его автозагрузку
> https://www.php.net/manual/ru/function.enum-exists.php

Функция считает перечислением только классы имплементирующие `\UnitEnum`. Если в функцию будет передан
интерфейс имплементирующий `\UnitEnum` - он также не пройдет проверку

## get_debug_type()

> get_debug_type() Вернет имя типа данных для переданного значения
> https://www.php.net/manual/ru/function.get-debug-type

Если тип данных не удалось определить (это невероятная ситуация) будет выброшено `\RuntimeException`. "Настоящая"
функция в такой ситуации завершилась бы критической ошибкой. Такое поведение было выбрано, для облегчения юнит-тестирования

## get_resource_id()

> get_resource_id() Вернет целочисленное представление ресурса
> https://www.php.net/manual/ru/function.get-resource-id.php

Если в функцию был передан не ресурс, будет выброшено `\TypeError`, "Настоящая функция" в таком случае
сгенерировала бы фатальную ошибку. Такое поведение было выбрано, для облегчения юнит-тестирования.

---

[<<< Оглавление](README.md)
