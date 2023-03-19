<?php

/**
 * Пример работы с "перечислениями" без типа @see AbstractEnum
 */

use DraculAid\Php8forPhp7\Enums\AbstractEnum;

/**
 * Пример создания Не типизированного перечислений
 * (Перечисление "Домашние животные")
 *
 * Перечисление будет содержать 2 варианта 'CAT' и 'DOG', в PHP8.1 это выглядело бы как:
 * ```php
 * enum PetsEnum {
 *  case CAT;
 *  case DOG;
 * }
 * ```
 */
class PetsEnum extends AbstractEnum
{
    // описание вариантов перечисления
    protected const __ENUM_VARIANTS = [
        'CAT' => null,
        'DOG' => null,
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

// первый котик
$barsik = new MyPets(PetsEnum::CAT(), 'Барсик');
// второй котик
$simba = new MyPets(PetsEnum::CAT(), 'Симба');

// собака
$archy = new MyPets(PetsEnum::DOG(), 'Арчи');

// * * *

// типы объектов "котиков" равны
echo "\n";
var_dump($barsik->type === $simba->type); // Вернет TRUE

// Типы объектов "котика" и "собаки" не равны
echo "\n";
var_dump($barsik->type === $archy->type); // Вернет FALSE

// * * *

// Вернет имя используемого варианта
echo "\n";
var_dump($barsik->type->name); // выведет "CAT"
