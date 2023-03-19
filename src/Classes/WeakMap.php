<?php declare(strict_types=1);

/*
 * This file is part of Php8forPhp7 - https://github.com/dracul-aid/Php8forPhp7
 *
 * (c) Konstantin Marataev <dracul.aid@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

if (!class_exists(WeakMap::class, false))
{
    /**
     * Класс, имитирующий WeakMap из PHP 8.0 - https://www.php.net/manual/ru/class.weakmap.php
     * В отличие от "настоящего WeakMap" - это факт создает ссылки на объекты-индексы
     */
    final class WeakMap implements ArrayAccess, Countable, IteratorAggregate
    {
        private \SplObjectStorage $objectStorage;

        public function __construct()
        {
            $this->objectStorage = new \SplObjectStorage();
        }

        /**
         * @return int
         */
        public function count(): int
        {
            return count($this->objectStorage);
        }

        /**
         * @return Iterator
         */
        public function getIterator(): Iterator
        {
            foreach ($this->objectStorage as $object)
            {
                yield $object => $this->objectStorage[$object];
            }
        }

        /**
         * @param object $object
         *
         * @return  bool
         */
        public function offsetExists($object): bool
        {
            return $this->objectStorage->offsetExists($object);
        }

        /**
         * @param object $object
         *
         * @return  mixed
         */
        public function offsetGet($object)
        {
            return $this->objectStorage->offsetGet($object);
        }

        /**
         * @param object $object
         * @param mixed $value
         *
         * @return  void
         */
        public function offsetSet($object, $value): void
        {
            $this->objectStorage->offsetSet($object, $value);
        }

        /**
         * @param object $object
         *
         * @return  void
         */
        public function offsetUnset($object): void
        {
            $this->objectStorage->offsetUnset($object);
        }
    }
}
