<?php

namespace DraculAid\Php8forPhp7\tests\Functions\_resources;

use DraculAid\Php8forPhp7\Enums\AbstractEnum;

/**
 * Используется в {@see EnumExistsTest} для проверки перечислений (только до PHP 8.1)
 */
class EnumExistsTest_ClassEnum extends AbstractEnum
{
    protected const __ENUM_VARIANTS = [
        'FIRST'=> null,
    ];
}
