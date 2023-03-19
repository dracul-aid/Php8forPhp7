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
    if (!function_exists('DraculAid\Php8forPhp7\str_starts_with'))
    {
        /**
         * Проверяет, начинается ли строка подстрокой
         *
         * Описание в мануале: https://www.php.net/manual/ru/function.str-starts-with.php
         *
         * @param   string   $haystack   Строка, в которой будет вестись поиск
         * @param   string   $needle     Подстрока, которую нужно найти
         *
         * @return  bool
         */
        function str_starts_with(string $haystack, string $needle): bool
        {
            // все строки начинаются с пустой строки
            return $needle === '' ||  strpos($haystack, $needle) === 0;
        }
    }
}

namespace
{
    if (!function_exists('str_starts_with'))
    {
        function str_starts_with(string $haystack, string $needle): bool
        {
            return DraculAid\Php8forPhp7\str_starts_with($haystack, $needle);
        }
    }
}
