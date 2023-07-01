<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use DraculAid\Php8forPhp7\tests\Functions\_resources\EnumExistsTest_ClassEnum;
use DraculAid\Php8forPhp7\tests\Functions\_resources\EnumExistsTest_Enum;
use DraculAid\Php8forPhp7\tests\Functions\_resources\EnumExistsTest_NotEnumClass;
use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\enum_exists()
 *
 * @run php tests/run.php tests/Functions/EnumExistsTest.php
 */
class EnumExistsTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/enum_exists.php');

        if (class_exists(EnumExistsTest_NotEnumClass::class, true)) die('!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
        var_dump(EnumExistsTest_Enum::cases());


        self::assertTrue(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_Enum::class));
        return;

        // * * *

        self::assertFalse(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_NotEnumClass::class, false));
        self::assertFalse(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_NotEnumClass::class, true));

        if (version_compare(PHP_VERSION, '8.1.0', '>='))
        {
            self::assertFalse(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_Enum::class, false));
            self::assertTrue(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_Enum::class));
        }
        else
        {
            self::assertFalse(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_ClassEnum::class, false));
            self::assertTrue(\DraculAid\Php8forPhp7\enum_exists(EnumExistsTest_ClassEnum::class));
        }

        // * * *

        $testInterfaceName = '___test_interface_name_' . uniqid() . '___';
        eval("interface {$testInterfaceName} extends \UnitEnum {}");

        self::assertFalse(\DraculAid\Php8forPhp7\enum_exists($testInterfaceName, false));
        self::assertFalse(\DraculAid\Php8forPhp7\enum_exists($testInterfaceName, true));
    }
}
