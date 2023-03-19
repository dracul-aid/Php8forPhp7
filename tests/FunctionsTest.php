<?php

namespace DraculAid\Php8forPhp7\tests;

use PHPUnit\Framework\TestCase;

/**
 * Test for src/functions.php
 *
 * @run php tests/run.php tests/FunctionsTest.php
 */
class FunctionsTest extends TestCase
{
    private const FUNCTIONS_FOR_TESTS = [
        'enum_exists',
        'array_is_list',
        'str_contains',
        'str_starts_with',
        'str_ends_with',
        'get_debug_type',
        'get_resource_id',
    ];

    public function testRun(): void
    {
        $pathLoad = dirname(__DIR__) . '/src/functions.php';
        require($pathLoad);

        // * * *

        foreach (self::FUNCTIONS_FOR_TESTS as $function)
        {
            self::assertTrue(function_exists($function), "Function {$function}() not found in {$pathLoad}");
        }
    }
}
