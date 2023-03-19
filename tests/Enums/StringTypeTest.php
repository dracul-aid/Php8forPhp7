<?php

namespace DraculAid\Php8forPhp7\tests\Enums;

use DraculAid\Php8forPhp7\Enums\AbstractEnumString;

/**
 * Test for @see AbstractEnumString
 *
 * @run php tests/run.php tests/Enums/StringTypeTest.php
 */
class StringTypeTest
{
    private const FIRST_VALUE = 'first_value';
    private const SECOND_VALUE = 'second_value';

    protected string $AbstractClassName = AbstractEnumString::class;
    protected $firstCaseValue = '"' . self::FIRST_VALUE . '"';
    protected $secondCaseValue = '"' . self::SECOND_VALUE . '"';

    public function testValue(): void
    {
        // тест имеет смысл только до PHP8.1
        if (version_compare(PHP_VERSION, '8.1.0', '>='))
        {
            self::assertTrue(true);
            return;
        }

        $this->createTestEnum();

        // * * *

        self::assertEquals(self::FIRST_VALUE, $this->testEnumName::FIRST()->value);
        self::assertEquals(self::SECOND_VALUE, $this->testEnumName::SECOND()->value);
    }
}
