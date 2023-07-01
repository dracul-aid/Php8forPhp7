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

// Если нет интерфейсов для перечислений - загрузим их
if (!interface_exists(\UnitEnum::class, false))
{
    require_once(dirname(__DIR__) . '/interfaces.php');
}

/**
 * Абстрактный класс для создания "Перечислений" максимально похожих на перечисления PHP8.1
 *
 * Все создаваемые вами перечисления должны наследовать одному из абстрактных классов:
 * <br>{@see AbstractEnum}         Для "нетепизированных" перечислений
 * <br>{@see AbstractEnumInt}      Для создания перечислений со значениями ввиде "целых чисел"
 * <br>{@see AbstractEnumString}   Для создания перечислений со значениями ввиде "строк"
 *
 * Варианты перечислений прописываются в {@see static::__ENUM_VARIANTS}
 *
 * @link https://github.com/dracul-aid/Php8forPhp7/blob/master/documentation-ru/enums.md Документация по классу-эмулятору перечислений
 * @link https://www.php.net/manual/ru/language.enumerations.overview.php О Перечислениях в PHP8.1
 *
 * "Виртуальные свойства", @see self::__get()
 * @property string $name [readonly] Вернет имя варианта перечисления
 * @property string $value [readonly] Вернет значение варианта перечисления (только для типизированных перечислений)
 */
abstract class AbstractEnum implements \UnitEnum
{
    /**
     * Используется для определения вариантов перечислений (переопределяется в каждом классе-перечислении)
     *
     * Представляет собой массив, в котором:
     * <br>+ Ключи: имена имен "вариантов перечислений" @see static::$__variant_name
     * <br>+ Значения: значения перечислений
     * <br>....> NULL - для НЕ типизированных перечислений
     * <br>....> int|string - для типизированных перечислений
     */
    protected const __ENUM_VARIANTS = [];

    /**
     * Хранит все созданные варианты перечислений
     *
     * Представляет собой 2-ух мерный массив:
     * <br>+ Индекс 1ур: [string] имя класса-перечисления
     * <br>+ Индекс 2ур: [string] имя "варианта перечисления"
     * <br>+ Значение: [object] объект-перечисление {@see AbstractEnum}
     */
    protected static array $__enum_variants = [];

    /**
     * Хранит все имена "Вариантов перечислений" по их "занчениям" (список "значения перечислений" к "именам вариантов перечислений")
     *
     * Представляет собой 2-ух мерный массив:
     * <br>+ Индекс 1ур: [string] имя класса-перечисления
     * <br>+ Индекс 2ур: [int|string] строка или число варианта перечисления
     * <br>+ Значение: [string] имя "варианта перечисления"
     */
    protected static array $__enum_names_by_value = [];

    /**
     * Имя варианта перечисления
     *
     * Представляет собой ключ в {@see static::__ENUM_VARIANTS}
     */
    protected string $__variant_name;

    /**
     * Создает перечисление
     *
     * @param   string   $index   Имя варианта перечисления
     *
     * $index представляет собой ключ из {@see static::__ENUM_VARIANTS}
     *
     * @throws  \LogicException  Если попытка создания "варианта перечисления" который не может быть в данном перечислении
     */
    protected function __construct(string $index)
    {
        if (!array_key_exists($index, static::__ENUM_VARIANTS))
        {
            throw new \LogicException("Class Enum does not have {$index} variant");
        }

        $this->__variant_name = $index;
    }

    public function __get(string $name)
    {
        if (is_callable([$this, "__get_var_{$name}"])) return [$this, "__get_var_{$name}"]();
        else throw new \LogicException("Property {$name} not found in " . static::class);
    }

    public static function __callStatic(string $name, array $arguments)
    {
        static::__create_cases();

        if (!array_key_exists($name, static::$__enum_variants[static::class]))
        {
            throw new \LogicException('Class enum ' . static::class . " does not have '{$name}' variant");
        }

        return static::$__enum_variants[static::class][$name];
    }

    /**
     * Вернет все объекты "Варианты перечисления"
     *
     * @return static[]
     */
    public static function cases(): array
    {
        static::__create_cases();

        return array_values(static::$__enum_variants[static::class]);
    }

    /**
     * Вернет имя варианта перечисления @see AbstractEnum::$name
     *
     * @return string
     */
    protected function __get_var_name(): string
    {
        return $this->__variant_name;
    }

    /**
     * Вернет имя варианта перечисления @see AbstractEnum::$name
     *
     * @return  int|string   Вернет целое число или строку (зависит от типа перечисления)
     *
     * @throws  \LogicException  Если попытка получить значение для не типизированного перечисления
     */
    protected function __get_var_value()
    {
        if (static::__ENUM_VARIANTS[$this->__variant_name] === null)
        {
            throw new \LogicException('Class enum ' . static::class . " does not have values");
        }

        return static::__ENUM_VARIANTS[$this->__variant_name];
    }

    /**
     * "Создает" все варианты перечислений для текущего перечисления. Также создает список "значения перечислений" к "именам вариантов перечислений"
     *
     * @return void
     */
    protected static function __create_cases(): void
    {
        if (isset(static::$__enum_variants[static::class])) return;

        static::$__enum_variants[static::class] = [];
        static::$__enum_names_by_value[static::class] = [];

        foreach (static::__ENUM_VARIANTS as $name => $value)
        {
            static::$__enum_variants[static::class][$name] = new static($name);
            if ($value !== null) static::$__enum_names_by_value[static::class][$value] = $name;
        }
    }
}
