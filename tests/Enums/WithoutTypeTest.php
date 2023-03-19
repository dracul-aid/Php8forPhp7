<?php

namespace DraculAid\Php8forPhp7\tests\Enums;

use DraculAid\Php8forPhp7\Enums\AbstractEnum;

/**
 * Test for @see AbstractEnum
 *
 * @run php tests/run.php tests/Enums/WithoutTypeTest.php
 */
class WithoutTypeTest extends AbstractTesting
{
    protected string $AbstractClassName = AbstractEnum::class;
    protected $firstCaseValue = 'null';
    protected $secondCaseValue = 'null';

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

        $this->expectException(\LogicException::class);

        $this->testEnumName::FIRST()->value;
    }
}
