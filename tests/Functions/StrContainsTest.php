<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\str_contains()
 *
 * @run php tests/run.php tests/Functions/StrContainsTest.php
 */
class StrContainsTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/str_contains.php');

        // * * *

        self::assertFalse(\DraculAid\Php8forPhp7\str_contains('1234567890', '22222'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_contains('ABC', 'ABCD'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_contains('ABC', 'Яхта'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_contains('Яхта', 'ABC'));
        self::assertFalse(\DraculAid\Php8forPhp7\str_contains('Яхта', 'Вяхточка'));

        // * * *

        // все строки включат в себя пустую строку (!)
        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('1234567890', ''));
        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('', ''));

        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('1234567890', '234'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('1234567890', '1234'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('1234567890', '890'));

        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('It is a PHP code', 'a PHP'));
        self::assertTrue(\DraculAid\Php8forPhp7\str_contains('Яхта плыла по волнам', 'плыла'));
    }
}
