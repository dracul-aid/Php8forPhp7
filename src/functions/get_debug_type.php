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
    if (!function_exists('DraculAid\Php8forPhp7\get_debug_type'))
    {
        /**
         * Возвращает имя типа переменной в виде, подходящем для отладки
         *
         * Описание в мануале: https://www.php.net/manual/ru/function.get-debug-type
         *
         * @param   mixed   $value   Значение, для которого нужно получить тип
         *
         * @return  string   Вернет строковое представление типа
         *
         * @throws  \RuntimeException  Если не удалось определить тип переменной (по идее такого быть не может, оставлено "на всякий пожарный")
         */
        function get_debug_type($value): string
        {
            static $replace = [
                'NULL'              => 'null',      'boolean'   => 'bool',     'string'  => 'string',
                'double'            => 'float',     'integer'   => 'int',      'array'   => 'array',
                'resource (closed)' => 'resource (closed)',
            ];

            // * * *

            if (is_object($value))
            {
                if ((new \ReflectionClass($value))->isAnonymous()) return 'class@anonymous';
                else return get_class($value);
            }
            else
            {
                $gettapeResult = gettype($value);

                if ($gettapeResult === 'resource') return 'resource (' . get_resource_type($value) . ')';
                elseif (isset($replace[$gettapeResult])) return $replace[$gettapeResult];
                else throw new \RuntimeException('$value is unknown type');
            }
        }
    }
}

namespace
{
    if (!function_exists('get_debug_type'))
    {
        function get_debug_type($value): string
        {
            return DraculAid\Php8forPhp7\get_debug_type($value);
        }
    }
}
