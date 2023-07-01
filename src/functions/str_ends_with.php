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
    if (!function_exists('DraculAid\Php8forPhp7\str_ends_with'))
    {
        /**
         * Проверяет, заканчивается ли строка подстрокой
         *
         * @param   string   $haystack   Строка, в которой будет вестись поиск
         * @param   string   $needle     Подстрока, которую нужно найти
         *
         * @return  bool
         *
         * @link https://www.php.net/manual/ru/function.str-ends-with Описание в PHP документации
         * @link https://github.com/dracul-aid/Php8forPhp7/blob/master/documentation-ru/functions.md Документация с нюансами работы функций имитаторов
         */
        function str_ends_with(string $haystack, string $needle): bool
        {
            // все строки заканчиваются пустой строкой
            if ('' === $needle || $needle === $haystack) return true;
            elseif ('' === $haystack) return false;

            // * * *

            $needleLength = strlen($needle);

            return $needleLength <= strlen($haystack) && substr_compare($haystack, $needle, -$needleLength) === 0;
        }
    }
}

namespace
{
    if (!function_exists('str_ends_with'))
    {
        function str_ends_with(string $haystack, string $needle): bool
        {
            return DraculAid\Php8forPhp7\str_ends_with($haystack, $needle);
        }
    }
}
