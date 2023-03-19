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
    if (!function_exists('DraculAid\Php8forPhp7\array_is_list'))
    {
        /**
         * Проверяет, является ли переданный массив "списком" (т.е. массивом с числовыми ключами идущими "последовательно")
         *
         * Описание в мануале: https://www.php.net/manual/ru/function.array-is-list.php
         *
         * @param   array   $array
         *
         * @return  bool
         */
        function array_is_list(array $array): bool
        {
            if (count($array) === 0) return true;

            return $array === array_values($array);
        }
    }
}

namespace
{
    if (!function_exists('array_is_list'))
    {
        function array_is_list(array $array): bool
        {
            return DraculAid\Php8forPhp7\array_is_list($array);
        }
    }
}
