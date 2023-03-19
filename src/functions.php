<?php declare(strict_types=1);

/*
 * This file is part of Php8forPhp7 - https://github.com/dracul-aid/Php8forPhp7
 *
 * (c) Konstantin Marataev <dracul.aid@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Файл содержит некоторые функции из PHP 8
 *
 * Все функции определяются дважды, для "глобального пространства имен" и в пространстве имен "DraculAid\Php8forPhp7"
 */

// === enum_exists() ===
if (!function_exists('enum_exists')) require(__DIR__ . '/functions/enum_exists.php');

// === array_is_list() ===
if (!function_exists('array_is_list')) require(__DIR__ . '/functions/array_is_list.php');

// === str_contains() ===
if (!function_exists('str_contains')) require(__DIR__ . '/functions/str_contains.php');

// === str_starts_with() ===
if (!function_exists('str_starts_with')) require(__DIR__ . '/functions/str_starts_with.php');

// === enum_exists() ===
if (!function_exists('str_ends_with')) require(__DIR__ . '/functions/str_ends_with.php');

// === get_resource_id() ===
if (!function_exists('get_resource_id')) require(__DIR__ . '/functions/get_resource_id.php');

// === get_debug_type() ===
if (!function_exists('get_debug_type')) require(__DIR__ . '/functions/get_debug_type.php');
