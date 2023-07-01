# Php8forPhp7 - Классы и функции PHP8 для PHP7

[Документация](documentation-ru/README.md) | [Примеры](examples-ru/README.md)

---

**Php8forPhp7** Содержит классы и функции из PHP8. Также библиотека содержит функционал, позволяющий создавать
классы-перечисления, максимально похожие в своем использовании на перечисления в PHP8

Библиотека не требует для своей работы никаких дополнительных пакетов. Если ваш проект не использует `composer`
в качестве менеджера пакетов или вы хотите внедрить библиотеку в ваш код, достаточно просто скопировать
содержимое каталога `src` из ветки `master`

## Установка

Установка с помощью композера ([packagist.org](https://packagist.org/packages/draculaid/php8forphp7)):
```console
composer require draculaid/php8forphp7
```

Вы также можете полностью скопировать содержимое каталога `src`, библиотека Php8forPhp7 включает в себя все
необходимое для ее работы (т.е. не имеет внешних зависимостей)

## Дерево каталогов

* `documentation-ru` Документация, [перейти в каталог](documentation-ru/README.md)
* `examples-ru` Примеры работы, [перейти в каталог](examples-ru/README.md)
* `src/functions.php` Содержит объявление всех функций
* `src/interfaces.php` Содержит объявление всех интерфейсов
* `src/functions` Содержит определение функций (один файл на одну функцию)
* `src/Classes` Содержит классы из PHP8
* `src/Enums` Содержит все необходимое для создания классов-перечислений, похожих на перечисления в PHP8
* `tests` Все что нужно для тестирования библиотеки, [подробнее](tests/README.md)

`src/functions` и `src/functions.php` Объявляют (если не были объявлены ранее) не только функции в глобальном
пространстве имен, но и "синонимы" в `DraculAid\Php8forPhp7` пространстве имен. Т.е. будут доступны две функции
`array_is_list()` и `\DraculAid\Php8forPhp7::array_is_list()`. При этом:
* `array_is_list()` Будет определена, если только еще не определена (другой библиотекой, или вы используете PHP8)
* `array_is_list()` в случае определения, будет проводить перевызов `\DraculAid\Php8forPhp7::array_is_list()`
* `\DraculAid\Php8forPhp7::array_is_list()` будет доступна всегда, вне зависимости от версии PHP, которую вы используете

`FunctionsTest.php` Содержит класс с функциями для валидации составных типов данных (например `string|array` или `A&B`)
[подробнее в документации](documentation-ru/type-validator.md).

`LoaderPhp8Lib.php` Содержит класс облегчающий загрузку необходимого функционала, [подробнее в документации](documentation-ru/loader.md).

## Реализованно

Перечисления, точнее функционал, для создания классов, максимально похожих на перечисления PHP8, см абстрактный
класс `\DraculAid\Php8forPhp\Enums\AbstractEnum`. Подробнее [в документации](documentation-ru/enums.md)

**Функции**
* `enum_exists()` Является ли указанный класс, перечислением
* `array_is_list()` Является ли массив списком
* `str_contains()` Содержит ли строка подстроку
* `str_starts_with()` Начинается ли строка подстрокой
* `str_ends_with()` Заканчивается ли строка подстрокой
* `get_debug_type()` Вернет имя типа данных
* `get_resource_id()` Вернет целочисленное представление ресурса

**Классы**

* `WeakMap` - "Массив", использующий в качестве ключей объекты, в отличие от настоящего `WeakMap` увеличивает счетчик ссылок на объект
