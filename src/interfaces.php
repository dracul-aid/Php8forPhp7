<?php declare(strict_types=1);

/*
 * This file is part of Php8forPhp7 - https://github.com/dracul-aid/Php8forPhp7
 *
 * (c) Konstantin Marataev <dracul.aid@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Файл содержит интерфейсы PHP 8
 *
 * Все интерфейсы определяются в глобальном пространстве имен. Определение происходит, если только интерфейс не был определен ранее
 */


// -- Stringable -------------------------------------------------------------------------------------------------------

if (!interface_exists(\Stringable::class, false))
{
    /**
     * Интерфейс, указывает, что объекты могут быть преобразованы в строку
     */
    interface Stringable
    {
        public function __toString(): string;
    }
}

// -- UnitEnum ---------------------------------------------------------------------------------------------------------

if (!interface_exists(\UnitEnum::class, false))
{
    /**
     * Используется для маркировки всех перечислений @see \DraculAid\Php8forPhp7\Enums\AbstractEnum
     *
     * @property string $name Хранит полное имя "варианта перечисления"
     */
    interface UnitEnum
    {
        /**
         * Вернет список всех "вариантов перечислений"
         *
         * @return static[]
         */
        public static function cases(): array;
    }
}

// -- BackedEnum -------------------------------------------------------------------------------------------------------

if (!interface_exists(\BackedEnum::class, false))
{
    /**
     * Используется для маркировки типизированных перечислений @see \DraculAid\Php8forPhp7\Enums\AbstractEnum
     *
     * Этот интерфейс не должен наследоваться классами напрямую, классы-перечисления должны реализовывать:
     * @see \UnitEnum для случаев, если перечисление не имеет значения
     * @see \IntBackedEnum для перечислений с целочисленными значениями
     * @see \StringBackedEnum для перечислений с строковыми значениями
     *
     *
     * @property string $name Хранит значение "варианта перечисления"
     */
    interface BackedEnum extends UnitEnum {}
}

// -- IntBackedEnum ----------------------------------------------------------------------------------------------------

if (!interface_exists(\IntBackedEnum::class, false))
{
    /**
     * Используется для маркировки "целочисленных" перечислений @see \DraculAid\Php8forPhp7\Enums\AbstractEnum
     *
     * @property int $value Хранит значение "Варианта перечисления"
     */
    interface IntBackedEnum extends BackedEnum
    {
        /**
         * Вернет "Вариант перечисления" по его значению или выбросит исключение
         *
         * @param   int   $value
         *
         * @return  static
         *
         * @throws  \TypeError   Если нет "Варианта перечисления" с таким значением
         * @throws  \TypeError   Если $value был передан не целым числом
         */
        public static function from(int $value): IntBackedEnum;

        /**
         * Вернет "Вариант перечисления" по его значению или NULL
         *
         * @param   int   $value
         *
         * @return  null|static  Если нет "варианта перечисления" с таким значением, вернет NULL
         *
         * @throws  \TypeError   Если $value был передан не целым числом
         */
        public static function tryFrom(int $value): ?IntBackedEnum;
    }
}

// -- IntBackedEnum ----------------------------------------------------------------------------------------------------

if (!interface_exists(\StringBackedEnum::class, false))
{
    /**
     * Используется для маркировки "строковых" перечислений @see \DraculAid\Php8forPhp7\Enums\AbstractEnum
     *
     * @property int $value Хранит значение "Варианта перечисления"
     */
    interface StringBackedEnum extends BackedEnum
    {
        /**
         * Вернет "Вариант перечисления" по его значению или выбросит исключение
         *
         * @param   string   $value
         *
         * @return  static
         *
         * @throws  \TypeError   Если нет "Варианта перечисления" с таким значением
         * @throws  \TypeError   Если $value был передан не строкой
         */
        public static function from(string $value): StringBackedEnum;

        /**
         * Вернет "Вариант перечисления" по его значению или NULL
         *
         * @param   string   $value
         *
         * @return  null|static  Если нет "варианта перечисления" с таким значением, вернет NULL
         *
         * @throws  \TypeError   Если $value был передан не строкой
         */
        public static function tryFrom(string $value): ?StringBackedEnum;
    }
}
