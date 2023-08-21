<?php declare(strict_types=1);

/*
 * This file is part of Php8forPhp7 - https://github.com/dracul-aid/Php8forPhp7
 *
 * (c) Konstantin Marataev <dracul.aid@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraculAid\Php8forPhp7;

// Если нет функции, для получения типа значения - загрузим функцию
if (!function_exists('get_debug_type'))
{
    require_once(__DIR__ . '/functions/get_debug_type.php');
}

/**
 * Класс для валидации составных типов данных
 *
 * Оглавление:
 * <br>{@see TypeValidator::validateOr()} Валидирует по "Одному из" типов данных (т.е. A|B|C)
 * <br>{@see TypeValidator::validateAnd()} Валидирует объекты по точному совпадению со всеми типами данных (т.е. A&B&C)
 *
 * @link https://github.com/dracul-aid/Php8forPhp7/blob/master/documentation-ru/type-validator.md Документация по работе с валидатором
 * @link https://www.php.net/manual/ru/language.types.declarations.php#language.types.declarations.composite Документация PHP о составных типах данных
 */
class TypeValidator
{
    /**
     * Проверяет, что переданное значение удовлетворяет одному из переданных типов данных. В случае провала может
     * выбросить {@see \TypeError}. Т.е. функция используется для проверки вида <code>A|B|C</code>
     *
     * @param   mixed      $value      Значение для проверки
     * @param   string[]   $typeList   Типы (как в PHP), значение должно соответствовать одному из указанных типов
     * @param   bool       $throw      TRUE, если при провале проверки - нужно выбросить исключение, или FALSE если нет
     *
     * @return  bool
     *
     * @throws  \TypeError   В случае, если значение не удовлетворяет переданному типу данных
     */
    public static function validateOr($value, array $typeList, bool $throw = true): bool
    {
        $varType = get_debug_type($value);

        /** @var string $varClassName Имя класса, если переданное значение было объектом (Пустая строка - значение не объект) */
        $varClassName = '';

        if (is_object($value))
        {
            $varType = 'object';
            $varClassName = get_class($value);
        }

        // * * *

        // Проверка базовых типов и проверка полного соответствия имени класса для объекта
        if (in_array($varType, $typeList) || ($varClassName !== '' && in_array($varClassName, $typeList)))
        {
            return true;
        }

        // логические псевдотипы
        if (is_bool($value) && ((!$value && in_array('false', $typeList)) || ($value && in_array('true', $typeList))))
        {
            return true;
        }

        // проверка callable
        if (is_callable($value) && in_array('callable', $typeList))
        {
            return true;
        }

        // проверка iterable
        if (is_iterable($value) && in_array('iterable', $typeList))
        {
            return true;
        }

        // * * *

        if ($throw) throw new \TypeError("Value is not correct type");

        return false;
    }

    /**
     * Проверяет, что переданное значение удовлетворяет всем типам данных. В случае провала может
     * выбросить {@see \TypeError}. Т.е. функция используется для проверки вида <code>A&B&C</code>
     *
     * (!) Проверка имеет смысл только для объектов, поэтому все НЕ ОБЪЕКТЫ провалят проверку
     *
     * @param   mixed      $value      Значение для проверки
     * @param   string[]   $typeList   Типы (как в PHP), значение должно соответствовать всем перечисленным типам
     * @param   bool       $throw      TRUE, если при провале проверки - нужно выбросить исключение, или FALSE если нет
     *
     * @return  bool
     *
     * @throws  \TypeError    В случае, если значение не удовлетворяет переданному типу данных
     */
    public static function validateAnd($value, array $typeList, bool $throw = true): bool
    {
        if (!is_object($value))
        {
            if ($throw) throw new \TypeError("Value can be the object");
            return false;
        }

        // * * *

        foreach ($typeList as $type)
        {
            if (!is_a($value, $type))
            {
                if ($throw) throw new \TypeError("Value is not correct type");
                return false;
            }
        }

        return true;
    }
}
