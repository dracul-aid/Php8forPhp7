# Php8forPhp7 - Нюансы WeakMap
[<<< Оглавление](README.md)

> Описание WeakMap в PHP 8.0 - https://www.php.net/manual/ru/class.weakmap.php

Для подключения WeakMap нужно вызвать файл `src/Classes/WeakMap.php`, WeakMap определен в глобальном пространстве
имен, это значит, что после переезда на PHP 8 вам нужно будет просто убрать подключение файла. Но даже не
убрав подключение ваш проект "не сломается", так как WeakMap будет определен, только в случае, если он не был
определен ранее

```php
// путь до библиотеки
$pathPhp8forPhp7 = 'vendor/DraculAid/Php8forPhp7';

// подключение класса
require_once($pathPhp8forPhp7 . '/src/Classes/WeakMap.php');
```

Единственным отличием **WeakMap в Php8forPhp7** от "настоящего WeakMap в PHP 8.0" заключается в том, что он
увеличивает счетчик ссылок на объект, т.е. работает в этом плане аналогично `\SplObjectStorage()`.

Возможность более удобной работы с WeakMap в `foreach`, по сравнению с SplObjectStorage сохранена
```php
$splStorage = new SplObjectStorage();
$splStorage[$object1] = 'AAA';
$splStorage[$object2] = 'BBB';

foreach ($splStorage as $index => $data)
{
    /**
     * @var   int      $index   Позиция в хранилище
     * @var   object   $data    Объект выступающий ключом
    */
    
    // Получение значения
    $splStorage[$data];
}

// * * *

$weakMap = new WeakMap();
$weakMap[$object1] = 'AAA';
$weakMap[$object2] = 'BBB';

foreach ($weakMap as $index => $data)
{
    /**
     * @var   object  $index   Объект выступающий ключом
     * @var   mixed   $data    Значение для ключа
    */
}
```

---

[<<< Оглавление](README.md)
