<?php

namespace DraculAid\Php8forPhp7\tests;

use DraculAid\Php8forPhp7\TypeValidator;
use PHPUnit\Framework\TestCase;

/**
 * Test for {@see TypeValidator}
 *
 * @run php tests/run.php tests/TypeValidatorTest.php
 */
class TypeValidatorTest extends TestCase
{
    /**
     * Test for {@see TypeValidator::validateOr()}
     */
    public function testValidateOr(): void
    {
        // Проверки для NULL
        self::assertTrue(TypeValidator::validateOr(null, ['null'], false));
        self::assertFalse(TypeValidator::validateOr(null, ['bool'], false));

        // Проверки для BOOLEAN
        self::assertTrue(TypeValidator::validateOr(false, ['bool'], false));
        self::assertTrue(TypeValidator::validateOr(true, ['bool'], false));
        self::assertFalse(TypeValidator::validateOr(false, ['int'], false));
        self::assertFalse(TypeValidator::validateOr(true, ['int'], false));

        // Проверки для псевдотипов BOOLEAN
        self::assertTrue(TypeValidator::validateOr(false, ['false'], false));
        self::assertTrue(TypeValidator::validateOr(true, ['true'], false));
        self::assertFalse(TypeValidator::validateOr(false, ['true'], false));
        self::assertFalse(TypeValidator::validateOr(true, ['false'], false));

        // Проверки INT
        self::assertTrue(TypeValidator::validateOr(123, ['int'], false));
        self::assertFalse(TypeValidator::validateOr(123, ['float'], false));

        // Проверки FLOAT
        self::assertTrue(TypeValidator::validateOr(123.0, ['float'], false));
        self::assertTrue(TypeValidator::validateOr(123.123, ['float'], false));
        self::assertFalse(TypeValidator::validateOr(123, ['float'], false));

        // Названия типов "похожие" на типы PHP, но таковыми не являющиеся
        self::assertFalse(TypeValidator::validateOr(123, ['integer'], false));
        self::assertFalse(TypeValidator::validateOr(123, ['number'], false));
        self::assertFalse(TypeValidator::validateOr(123.123, ['double'], false));

        // Строки STRING
        self::assertTrue(TypeValidator::validateOr('', ['string'], false));
        self::assertTrue(TypeValidator::validateOr('123', ['string'], false));

        // Проверка ARRAY
        self::assertTrue(TypeValidator::validateOr([], ['array'], false));
        self::assertTrue(TypeValidator::validateOr([1, 2, 3], ['array'], false));
        self::assertFalse(TypeValidator::validateOr(new \stdClass(), ['array'], false));

        // Базовая проверка OBJECT
        self::assertTrue(TypeValidator::validateOr(new \stdClass(), ['object'], false));
        self::assertFalse(TypeValidator::validateOr(['a' => 1, 'b' => 2], ['object'], false));

        // Строгое соответствие имени класса
        self::assertTrue(TypeValidator::validateOr(new \stdClass(), [\stdClass::class], false));
        self::assertTrue(TypeValidator::validateOr($this, [TypeValidatorTest::class], false));
        self::assertFalse(TypeValidator::validateOr(new \stdClass(), [TypeValidatorTest::class], false));
        self::assertFalse(TypeValidator::validateOr($this, [\stdClass::class], false));

        // * * * Проверка срабатывания, если указано несколько типов

        self::assertTrue(TypeValidator::validateOr(false, ['null', 'false'], false));
        self::assertTrue(TypeValidator::validateOr(true, ['int', 'true'], false));

        self::assertTrue(TypeValidator::validateOr(new \stdClass(), ['array', 'object'], false));
        self::assertTrue(TypeValidator::validateOr(new \stdClass(), ['array', \stdClass::class], false));
        self::assertFalse(TypeValidator::validateOr(new \stdClass(), ['int', 'string'], false));
    }

    /**
     * Test for {@see TypeValidator::validateAnd()}
     */
    public function testValidateAnd(): void
    {
        self::assertTrue(TypeValidator::validateAnd(new \stdClass(), [\stdClass::class], false));
        self::assertFalse(TypeValidator::validateAnd(new \Exception(), [\stdClass::class], false));

        self::assertTrue(TypeValidator::validateAnd(new \Exception(), [\Exception::class], false));
        self::assertTrue(TypeValidator::validateAnd(new \Exception(), [\Exception::class, \Throwable::class], false));

        self::assertFalse(TypeValidator::validateAnd(new \stdClass(), [_____notClass1231312314244_____::class], false));
        self::assertFalse(TypeValidator::validateAnd(new \stdClass(), [\stdClass::class, _____notClass1231312314244_____::class], false));
    }
}
