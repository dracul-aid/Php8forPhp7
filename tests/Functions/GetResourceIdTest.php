<?php

namespace DraculAid\Php8forPhp7\tests\Functions;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see \DraculAid\Php8forPhp7\get_resource_id()
 *
 * @run php tests/run.php tests/Functions/GetResourceIdTest.php
 */
class GetResourceIdTest extends TestCase
{
    public function testFunction(): void
    {
        require(dirname(__DIR__, 2) . '/src/functions/get_resource_id.php');

        // * * *

        $fId = fopen(__FILE__, 'r');

        self::assertEquals((int) $fId, \DraculAid\Php8forPhp7\get_resource_id($fId));

        // * * *

        $this->expectException(\TypeError::class);

        \DraculAid\Php8forPhp7\get_resource_id('XXX');
    }
}
