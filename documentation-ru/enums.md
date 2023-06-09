# Php8forPhp7 - Перечисления
[<<< Оглавление](README.md)

* [Пример работы с перечислениями](../examples-ru/enum.php)
* [Пример работы с типизированными перечислениями](../examples-ru/emum-with-type.php)

**Php8forPhp7** предоставляет абстрактный класс `\DraculAid\Php8forPhp7\Enums\AbstractEnum` для создания перечислений
максимально **похожих на перечисления в PHP 8.1**. `AbstractEnum` имеет все нужные методы и свойства перечислений, но
не имеет возможности определять и вызывать варианты перечислений, как константы класса. Варианты перечислений
описываются в специальной не публичной константе, а вызываются как статические методы, после перехода на "настоящие"
перечисления вам нужно будет только удалить скобки.

**Php8forPhp7** также предоставляет абстрактные классы для типизированных перечислений:
* `AbstractEnumInt` Для целочисленных перечислений
* `AbstractEnumString` Для строковых перечислений

Абстрактные классы-перечисления **Php8forPhp7**-а имплементируют интерфейсы перечислений (описаны в `src/inrefaces.php`)

**Php8forPhp7** Также имеет функцию `enum_exists()`, она проверяет, загружено ли перечисление и, если нет, 
загружает его (вызывает автозагрузку). Для проверки "на перечисление", используется проверка на наличие базового интерфейса
перечислений `UnitEnum`

## Пример (для типизированного перечисления)

### Код в PHP 7.4.x - 8.0.x

**Определение перечисления**
```php
use DraculAid\Php8forPhp7\Enums\AbstractEnumString;

// объявление перечисления
class PetsEnum extends AbstractEnumString
{
    // описание вариантов перечисления
    protected const __ENUM_VARIANTS = [
        'CAT' => 'кошка',
        'DOG' => 'собака',
    ];
}
```

**Использование перечисления**
```php
use DraculAid\Php8forPhp7\Enums\AbstractEnumString;

// получение варианта перечисления "CAT"
$petsEnumVariant = PetsEnum()::CAT();

// получение значения варианта перечисления "CAT"
$petsEnumVariant->value;
PetsEnum()::CAT()->value;

// сравнение перечислений
$petsEnumVariant === PetsEnum()::CAT();
```

## Код, после переезда на PHP 8.1 и выше

**Определение перечисления**
```php
enum PetsEnum
{
    case CAT = 'кошка';
    case DOG = 'собака';
}
```

**Использование перечисления**
```php
// получение варианта перечисления "CAT"
$petsEnumVariant = PetsEnum()::CAT;

// получение значения варианта перечисления "CAT"
$petsEnumVariant->value;
PetsEnum()::CAT->value;

// сравнение перечислений
$petsEnumVariant === PetsEnum()::CAT;
```

---

[<<< Оглавление](README.md)
