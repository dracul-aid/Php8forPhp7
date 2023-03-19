<?php declare(strict_types=1);

/*
 * This file is part of Php8forPhp7 - https://github.com/dracul-aid/Php8forPhp7
 *
 * (c) Konstantin Marataev <dracul.aid@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraculAid\Php8forPhp7\Enums;

/**
 * Абстрактный класс для создания типизированных (целое число) перечислений
 *
 * Варианты перечислений прописываются в @see static::ENUM_VARIANTS
 */
abstract class AbstractEnumInt extends AbstractEnum implements \IntBackedEnum
{
    public static function from(int $value): \IntBackedEnum
    {
        static::__create_cases();

        if (!array_key_exists($value, static::$__enum_names_by_value[static::class])) throw new \TypeError('Class Enum ' . static::class . " does not have variant for '{$value}'");

        return static::$__enum_names_by_value[static::class];
    }

    public static function tryFrom(int $value): ?\IntBackedEnum
    {
        static::__create_cases();

        return static::$__enum_names_by_value[static::class][$value] ?? null;
    }
}
