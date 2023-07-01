<?php declare(strict_types=1);

/*
 * This file is part of Php8forPhp7 - https://github.com/dracul-aid/Php8forPhp7
 *
 * (c) Konstantin Marataev <dracul.aid@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraculAid\Php8forPhp7
{
    if (!function_exists('DraculAid\Php8forPhp7\enum_exists'))
    {
        /**
         * Проверяет, загружено ли перечисление (проверяет, является ли указанная строка, классом, загружен ли этот класс
         * и является ли он перечислением)
         *
         * Классы считаются перечислениями, если они имплементируют интерфейс {@see \UnitEnum}
         * Для создания перечислений {@see \DraculAid\Php8forPhp7\Enums\AbstractEnum}
         *
         * @param   string   $enum       Полное имя класса-перечисления
         * @param   bool     $autoload   Нужно ли провести автозагрузку класса (если он не был загружен)
         *
         * @return  bool
         *
         * @link https://www.php.net/manual/ru/function.enum-exists.php Описание в PHP документации
         * @link https://github.com/dracul-aid/Php8forPhp7/blob/master/documentation-ru/functions.md Документация с нюансами работы функций имитаторов
         */
        function enum_exists(string $enum, bool $autoload = true): bool
        {
            if (!class_exists($enum, $autoload)) return false;

            if (interface_exists($enum, false)) return false;

            return is_subclass_of($enum, \UnitEnum::class);
        }
    }
}

namespace
{
    if (!function_exists('enum_exists'))
    {
        function enum_exists(string $enum, bool $autoload = true): bool
        {
            return DraculAid\Php8forPhp7\enum_exists($enum, $autoload);
        }
    }
}
