<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\get_debug_type()
 *
 * @run php tests/run.php tests/Functions/GetDebugTypeTest.php
 */
class GetDebugTypeTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/get_debug_type.php');

        // * * *

        self::assertEquals('null', \DraculAid\Php8forPhp7\get_debug_type(null));

        self::assertEquals('bool', \DraculAid\Php8forPhp7\get_debug_type(false));
        self::assertEquals('bool', \DraculAid\Php8forPhp7\get_debug_type(true));

        self::assertEquals('int', \DraculAid\Php8forPhp7\get_debug_type(0));
        self::assertEquals('int', \DraculAid\Php8forPhp7\get_debug_type(-123));
        self::assertEquals('int', \DraculAid\Php8forPhp7\get_debug_type(123));

        self::assertEquals('float', \DraculAid\Php8forPhp7\get_debug_type(0.123));
        self::assertEquals('float', \DraculAid\Php8forPhp7\get_debug_type(-0.123));

        self::assertEquals('string', \DraculAid\Php8forPhp7\get_debug_type(''));
        self::assertEquals('string', \DraculAid\Php8forPhp7\get_debug_type('0'));
        self::assertEquals('string', \DraculAid\Php8forPhp7\get_debug_type('string'));

        self::assertEquals('array', \DraculAid\Php8forPhp7\get_debug_type([]));
        self::assertEquals('array', \DraculAid\Php8forPhp7\get_debug_type([1, 2, 3]));
        self::assertEquals('array', \DraculAid\Php8forPhp7\get_debug_type(['a' => 1, 'b' => 2]));

        // * * *

        $fId = fopen(__FILE__, 'r');
        self::assertEquals('resource (stream)', \DraculAid\Php8forPhp7\get_debug_type($fId));
        fclose($fId);
        self::assertEquals('resource (closed)', \DraculAid\Php8forPhp7\get_debug_type($fId));

        // * * *

        self::assertEquals(GetDebugTypeTest::class, \DraculAid\Php8forPhp7\get_debug_type($this));

        // * * *

        self::assertEquals('class@anonymous', \DraculAid\Php8forPhp7\get_debug_type(new class() {}));
    }
}
