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

/**
 * Осуществляет загрузку библиотеки
 *
 * Оглавление:
 * <br>{@see LoaderPhp8Lib::loadWeakMap()} Загрузка "Имитатора {@see \WeakMap}"
 * <br>{@see LoaderPhp8Lib::loadInterfaces()} Загрузка интерфейсов
 * <br>{@see LoaderPhp8Lib::loadAllFunctions()} Загрузка всех функций
 * <br>{@see LoaderPhp8Lib::loadFunction()} Загрузка указанной функции
 *
 * @link https://github.com/dracul-aid/Php8forPhp7/blob/master/documentation-ru/loader.md Документация по работе c загрузчиком
 */
final class LoaderPhp8Lib
{
    /**
     * Осуществляет загрузку {@see \WeakMap} (Класса, имитирующий WeakMap из PHP 8.0)
     * В отличие от "настоящего WeakMap" - это факт создает ссылки на объекты-индексы
     *
     * @link https://github.com/dracul-aid/Php8forPhp7/blob/master/documentation-ru/class-weakmap.md Документация по классу-имитатору WeakMap
     * @link https://www.php.net/manual/ru/class.weakmap.php Документация по WeakMap из PHP 8.0
     *
     * @return void
     */
    public static function loadWeakMap(): void
    {
        if (class_exists(\WeakMap::class, false)) return;

        require_once(__DIR__ . '/Classes/WeakMap.php');
    }

    /**
     * Осуществляет загрузку интерфейсов PHP8.*.*
     *
     * @param   bool   $alwaysLoad   Если TRUE - интерфейсы будут загружены всегда (но если они уже объявлены, переопределения не произойдет)
     *
     * @return  void
     */
    public static function loadInterfaces(bool $alwaysLoad = false): void
    {
        // Если не загружен \UnitEnum - это значит версия PHP меньше 8.1 при этом будет загружен и \Stringable
        // Если вы используете PHP 8.0.* Это не вызовет проблемы, так как перед объявлением интерфейса стоит проверка
        if (!$alwaysLoad && interface_exists(\UnitEnum::class, false)) return;

        require_once(__DIR__ . '/interfaces.php');
    }

    /**
     * Осуществляет загрузку всех функций PHP8
     *
     * @param   bool   $alwaysLoad   Если TRUE - то функции будет загружена всегда, может понадобиться если нужны функции аналоги из DraculAid\Php8forPhp7
     *
     * @return  void
     */
    public static function loadAllFunctions(bool $alwaysLoad = false): void
    {
        if (!$alwaysLoad && version_compare(PHP_VERSION, '8.0.0', '>=')) return;

        require_once(__DIR__ . '/functions.php');
    }

    /**
     * Осуществляет загрузку указанной функции PHP8
     *
     * @param   string   $function     Имя загружаемой функции
     * @param   bool     $alwaysLoad   Если TRUE - то функция будет загружена всегда, может понадобиться если нужны функция аналог из DraculAid\Php8forPhp7
     *
     * @return  void
     */
    public static function loadFunction(string $function, bool $alwaysLoad = false): void
    {
        if (!$alwaysLoad && function_exists($function)) return;

        require_once(__DIR__ . "/functions/{$function}.php");
    }
}
