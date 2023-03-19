<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\str_ends_with()
 *
 * @run php tests/run.php tests/Functions/StrContainsTest.php
 */
class StrEndsWithTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/str_ends_with.php');

        // * * *

        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('1234567890', '22222'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('ABC', 'ABCD'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('ABC', 'ZABC'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('ABC', 'Яхта'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('Яхта', 'ABC'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('Яхта', 'ТЯхта'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_ends_with('Яхта', 'Яхта!'));

        // * * *

        // все строки включат в себя пустую строку (!)
        self::assertTrue(\DraculAid\Php8forPhp7\str_ends_with('1234567890', ''));
        self::assertTrue(\DraculAid\Php8forPhp7\str_ends_with('', ''));

        self::assertTrue(\DraculAid\Php8forPhp7\str_ends_with('1234567890', '890'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_ends_with('1234567890', '1234567890'));

        self::assertTrue(\DraculAid\Php8forPhp7\str_ends_with('It is a PHP code', 'PHP code'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_ends_with('Яхта плыла по волнам', 'олнам'));
    }
}
