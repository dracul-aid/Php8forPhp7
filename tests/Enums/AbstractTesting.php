<?php

namespace DraculAid\Php8forPhp7\tests\Enums;

use DraculAid\Php8forPhp7\Enums\AbstractEnum;
use PHPUnit\Framework\TestCase;

abstract class AbstractTesting extends TestCase
{
    protected string $AbstractClassName;
    protected string $testEnumName;
    protected $firstCaseValue;
    protected $secondCaseValue;

    /**
     * Test for @see AbstractEnum::$name
     */
    public function testName(): void
    {
        // тест имеет смысл только до PHP8.1
        if (version_compare(PHP_VERSION, '8.1.0', '>='))
        {
            self::assertTrue(true);
            return;
        }

        $this->createTestEnum();

        // * * *

        self::assertEquals('FIRST', $this->testEnumName::FIRST()->name);
        self::assertEquals('SECOND', $this->testEnumName::SECOND()->name);
    }

    /**
     * Test for @see AbstractEnum::cases()
     */
    public function testGetAllCases(): void
    {
        // тест имеет смысл только до PHP8.1
        if (version_compare(PHP_VERSION, '8.1.0', '>='))
        {
            self::assertTrue(true);
            return;
        }

        $this->createTestEnum();

        // * * *

        self::assertEquals([$this->testEnumName::FIRST(), $this->testEnumName::SECOND()], $this->testEnumName::cases());
    }

    protected function createTestEnum(): void
    {
        $this->testEnumName = '___test_enum_name_' . uniqid() . '___';

        eval("class {$this->testEnumName} extends {$this->AbstractClassName} {
                protected const __ENUM_VARIANTS = [
                    'FIRST' => {$this->firstCaseValue},
                    'SECOND' => {$this->secondCaseValue},
                ];
            }");
    }
}
