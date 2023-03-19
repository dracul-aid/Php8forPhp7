<?php

/**
 * Пример работы с "перечислениями" с типом
 * @see AbstractEnumInt    Перечисления типизированные как целые числа
 * @see AbstractEnumString Перечисления типизированные как строки
 */

use DraculAid\Php8forPhp7\Enums\AbstractEnumInt;
use DraculAid\Php8forPhp7\Enums\AbstractEnumString;

/**
 * Пример создания Не типизированного перечислений
 * (Перечисление "Домашние животные")
 *
 * Перечисление будет содержать 2 варианта 'CAT' и 'DOG', в PHP8.1 это выглядело бы как:
 * ```php
 * enum PetsEnum {
 *  case OTHER = 0;
 *  case CAT = 1;
 *  case DOG = 2;
 * }
 * ```
 */
class PetsEnum extends AbstractEnumInt
{
    // описание вариантов перечисления
    protected const __ENUM_VARIANTS = [
        'OTHER' => 0,
        'CAT' => 1,
        'DOG' => 2,
    ];
}


/**
 * Класс с примером использования перечисления
 * (Класс "Домашнее животное)
 */
class MyPets
{
    /**
     * Тип домашнего животного (один из вариантов перечисления)
     */
    public PetsEnum $type;

    /**
     * Имя животного
     */
    public string $name;

    public function __construct(PetsEnum $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;
    }
}

/**
 * Как работа с перечислением будет выглядеть в коде
 */

// Котик
$barsik = new MyPets(PetsEnum::CAT(), 'Барсик');
// собака
$archy = new MyPets(PetsEnum::DOG(), 'Арчи');
// кролик
$objorka = new MyPets(PetsEnum::OTHER(), 'Обжорка');

// * * *

// Вернет имя используемого варианта
echo "\n";
var_dump($barsik->type->name); // выведет "CAT"

// Вернет имя значение варианта
echo "\n";
var_dump($barsik->type->value); // выведет 1
