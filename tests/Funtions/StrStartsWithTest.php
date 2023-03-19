<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\str_starts_with()
 *
 * @run php tests/run.php tests/Functions/StrStartsWithTest.php
 */
class StrStartsWithTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/str_starts_with.php');

        // * * *

        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('1234567890', '22222'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('1234567890', '2345'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('ABC', 'ABCD'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('ABC', 'Яхта'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('Яхта', 'ABC'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('Яхта', 'ТЯхта'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_starts_with('Яхта', 'Яхта!'));

        // * * *

        self::assertTrue(\DraculAid\Php8forPhp7\str_starts_with('1234567890', ''));
        self::assertTrue(\DraculAid\Php8forPhp7\str_starts_with('', ''));

        self::assertTrue(\DraculAid\Php8forPhp7\str_starts_with('1234567890', '123'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_starts_with('1234567890', '1234567890'));

        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('It is a PHP code', 'It is'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('Яхта плыла по волнам', 'Яхта'));
    }
}
