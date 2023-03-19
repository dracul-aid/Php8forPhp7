<?php

namespace DraculAid\Php8forPhp7\tests\Enums;

use DraculAid\Php8forPhp7\Enums\AbstractEnumInt;

/**
 * Test for @see AbstractEnumInt
 *
 * @run php tests/run.php tests/Enums/IntTypeTest.php
 */
class IntTypeTest extends AbstractTesting
{
    protected string $AbstractClassName = AbstractEnumInt::class;
    protected $firstCaseValue = '111';
    protected $secondCaseValue = '222';

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

        self::assertEquals((int) $this->firstCaseValue, $this->testEnumName::FIRST()->value);
        self::assertEquals((int) $this->secondCaseValue, $this->testEnumName::SECOND()->value);
    }
}
