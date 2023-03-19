<?php

namespace DraculAid\Php8forPhp7\tests\Classes;

use PHPUnit\Framework\TestCase;

/**
 * Test for @see WeakMap
 *
 * @run php tests/run.php tests/Classes/WeakMapTest.php
 */
class WeakMapTest extends TestCase
{
    public function testRun(): void
    {
        // тест имеет смысл только до PHP8.1
        if (version_compare(PHP_VERSION, '8.0.0', '>='))
        {
            self::assertTrue(true);
            return;
        }

        require(dirname(__DIR__, 2) . '/src/Classes/WeakMap.php');

        // * * *

        $testObject = new \WeakMap();
        self::assertCount(0, $testObject);

        // * * *

        $firstIndex = new \stdClass();
        $testObject[$firstIndex] = 'AAA';
        self::assertCount(1, $testObject);

        $secondIndex = new \stdClass();
        $testObject[$secondIndex] = 'BBB';
        self::assertCount(2, $testObject);

        // * * *

        $equalsArray = [[$firstIndex, 'AAA'], [$secondIndex, 'BBB']];
        $equalsIndex = 0;
        foreach ($testObject as $index => $value)
        {
            self::assertEquals($equalsArray[$equalsIndex][0], $index);
            self::assertEquals($equalsArray[$equalsIndex][1], $value);
            $equalsIndex++;
        }

        // * * *

        self::assertEquals('AAA', $testObject[$firstIndex]);
        self::assertEquals('BBB', $testObject[$secondIndex]);
        $testObject[$secondIndex] = 'CCC';
        self::assertEquals('CCC', $testObject[$secondIndex]);

        // * * *

        unset($testObject[$firstIndex]);
        self::assertCount(1, $testObject);
        self::assertEquals('CCC', $testObject[$secondIndex]);
    }
}
