<?php

namespace DraculAid\Php8forPhp7\tests;

use PHPUnit\Framework\TestCase;

/**
 * Test for src/interfaces.php
 */
class InterfacesTest extends TestCase
{
    private const INTERFACES_FOR_TEST = [
        \Stringable::class,
        \UnitEnum::class,
        \BackedEnum::class,
        \IntBackedEnum::class,
        \StringBackedEnum::class,
    ];

    public function testRun(): void
    {
        // нет смысла проводить тест на PHP8
        if (PHP_MAJOR_VERSION > 7)
        {
            self::assertTrue(true);
            return;
        }

        $pathLoad = dirname(__DIR__) . '/src/interfaces.php';
        require($pathLoad);

        // * * *

        foreach (self::INTERFACES_FOR_TEST as $interface )
        {
            self::assertTrue(interface_exists($interface, false), "Interface {$interface} not found in {$pathLoad}");
        }
    }
}
