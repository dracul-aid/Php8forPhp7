<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\array_is_list()
 *
 * @run php tests/run.php tests/Functions/ArrayIsListTest.php
 */
class ArrayIsListTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/array_is_list.php');

        // * * *

        self::assertFalse(\DraculAid\Php8forPhp7\array_is_list(['aaa' => '123']));
        self::assertFalse(\DraculAid\Php8forPhp7\array_is_list([1 => '123']));
        self::assertFalse(\DraculAid\Php8forPhp7\array_is_list([0 => '123', '2' => 'ABC']));

        // * * *

        self::assertTrue(\DraculAid\Php8forPhp7\array_is_list([]));
        self::assertTrue(\DraculAid\Php8forPhp7\array_is_list([0 => '123']));
        self::assertTrue(\DraculAid\Php8forPhp7\array_is_list([0 => '123', '1' => 'ABC']));
        self::assertTrue(\DraculAid\Php8forPhp7\array_is_list(['123', 'ABC']));
    }
}
