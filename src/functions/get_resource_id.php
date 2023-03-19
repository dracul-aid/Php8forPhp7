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
    if (!function_exists('DraculAid\Php8forPhp7\get_resource_id'))
    {
        /**
         * Возвращает числовое представление ресурса (преобразует ресурс к целому числу)
         *
         * Описание в мануале: https://www.php.net/manual/ru/function.get-resource-id.php
         *
         * @param   resource   $resource   Строка, в которой будет вестись поиск
         *
         * @return  int
         *
         * @throws  \TypeError   Если был передан не ресурс
         */
        function get_resource_id($resource): int
        {
            if (!is_resource($resource)) throw new \TypeError('$resource is not resource');

            return (int) $resource;
        }
    }
}

namespace
{
    if (!function_exists('get_resource_id'))
    {
        function get_resource_id($resource): int
        {
            return DraculAid\Php8forPhp7\get_resource_id($resource);
        }
    }
}
