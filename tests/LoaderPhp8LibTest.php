<?php

namespace DraculAid\Php8forPhp7\tests;

use DraculAid\Php8forPhp7\LoaderPhp8Lib;
use PHPUnit\Framework\TestCase;

/**
 * Test for {@see LoaderPhp8Lib}
 *
 * @run php tests/run.php tests/LoaderPhp8LibTest.php
 */
class LoaderPhp8LibTest extends TestCase
{
    /**
     * Test for {@see LoaderPhp8Lib::loadWeakMap()}
     * Test for {@see LoaderPhp8Lib::loadInterfaces()}
     * Test for {@see LoaderPhp8Lib::loadAllFunctions()}
     * Test for {@see LoaderPhp8Lib::loadFunction()}
     */
    public function testRun(): void
    {
        LoaderPhp8Lib::loadWeakMap();
        self::assertTrue(class_exists(\WeakMap::class, false));

        LoaderPhp8Lib::loadInterfaces();
        self::assertTrue(interface_exists(\Stringable::class, false));
        self::assertTrue(interface_exists(\UnitEnum::class, false));

        LoaderPhp8Lib::loadFunction('array_is_list');
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\array_is_list'));
        self::assertTrue(function_exists('array_is_list'));

        LoaderPhp8Lib::loadAllFunctions();
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\enum_exists'));
        self::assertTrue(function_exists('enum_exists'));
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\str_contains'));
        self::assertTrue(function_exists('str_contains'));
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\str_starts_with'));
        self::assertTrue(function_exists('str_starts_with'));
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\str_ends_with'));
        self::assertTrue(function_exists('str_ends_with'));
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\get_resource_id'));
        self::assertTrue(function_exists('get_resource_id'));
        self::assertTrue(function_exists('DraculAid\Php8forPhp7\get_debug_type'));
        self::assertTrue(function_exists('get_debug_type'));
    }
}
