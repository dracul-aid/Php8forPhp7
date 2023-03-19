<?php

namespace DraculAid\Php8forPhp7\tests\Enums;

use DraculAid\Php8forPhp7\Enums\AbstractEnum;
use DraculAid\Php8forPhp7\Enums\AbstractEnumInt;
use DraculAid\Php8forPhp7\Enums\AbstractEnumString;
use PHPUnit\Framework\TestCase;

/**
 * Test for
 * @see AbstractEnum
 * @see AbstractEnumInt
 * @see AbstractEnumString
 *
 * @run php tests/run.php tests/Functions/StructureTest.php
 */
class StructureTest extends TestCase
{
    public function testInterfacesAndParent(): void
    {
        // тест имеет смысл только до PHP8.1
        if (version_compare(PHP_VERSION, '8.1.0', '>='))
        {
            self::assertTrue(true);
            return;
        }

        // * * *

        require(dirname(__DIR__, 2) . '/src/interfaces.php');

        // * * *

        self::assertTrue(is_subclass_of(AbstractEnum::class, \UnitEnum::class));

        self::assertTrue(is_subclass_of(AbstractEnumInt::class, AbstractEnum::class));
        self::assertTrue(is_subclass_of(AbstractEnumInt::class, \UnitEnum::class));
        self::assertTrue(is_subclass_of(AbstractEnumInt::class, \BackedEnum::class));
        self::assertTrue(is_subclass_of(AbstractEnumInt::class, \IntBackedEnum::class));

        self::assertTrue(is_subclass_of(AbstractEnumString::class, AbstractEnum::class));
        self::assertTrue(is_subclass_of(AbstractEnumString::class, \UnitEnum::class));
        self::assertTrue(is_subclass_of(AbstractEnumString::class, \BackedEnum::class));
        self::assertTrue(is_subclass_of(AbstractEnumString::class, \StringBackedEnum::class));
    }
}
