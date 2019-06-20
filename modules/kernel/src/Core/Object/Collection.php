<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Object;

use ArrayAccess;
use ArrayIterator;
use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Core\Helper\ExtractableHelper;
use Amazium\Kernel\Core\Object\Exception\InvalidObjectProvidedToCollectionException;
use Countable;
use IteratorAggregate;
use Serializable;
use Traversable;

abstract class Collection implements Extractable, IteratorAggregate, ArrayAccess, Serializable, Countable
{
    /** @var array */
    private $items;

    /** @var array */
    private $keys = [];

    /**
     * Name of the expected element class
     *
     * @return string
     */
    abstract public static function elementClass(): string;

    /**
     * Collection constructor.
     * @param array $input
     */
    public function __construct(array $input = [])
    {
        $this->exchangeArray($input);
    }

    /**
     * Is a provided element valid for this collection
     *
     * @param mixed $element
     * @return bool
     */
    public function isValidElement($element): bool
    {
        $elementClass = self::elementClass();
        return (is_object($element) && $element instanceof $elementClass);
    }

    /**
     * @param array $element
     * @return mixed|null
     */
    public function createElementFromArray(array $element)
    {
        return ObjectFromArray::createFromArray(self::elementClass(), $element);
    }

    /**
     * @param string $key
     * @return int
     */
    private function keyIndex(string $key): int
    {
        if (!isset($this->keys[$key])) {
            return null;
        }
        return $this->keys[$key];
    }

    /**
     * @param $offset
     * @return int
     */
    private function offset($offset): int
    {
        if (is_string($offset)) {
            $offset = $this->keyIndex($offset);
        }
        if (is_null($offset) || !isset($this->items[$offset])) {
            return null;
        }
        return $this->items[$offset];
    }

    /**
     * @return Traversable|void
     */
    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        $offset = $this->offset($offset);
        return !is_null($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        $offset = $this->offset($offset);
        if (is_null($offset)) {
            return null;
        }
        return $this->items[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        // If we are an array, attempt to create an element object
        if (is_array($value)) {
            $value = $this->createElementFromArray($value);
        }

        // Check if we received a valid element
        if (!$this->isValidElement($value)) {
            throw InvalidObjectProvidedToCollectionException::withClassNames(
                static::class,
                self::elementClass(),
                is_object($value) ? get_class($value) : gettype($value)
            );
        }

        // Transform a string key to numeric key
        if (is_string($offset)) {
            $index = $this->keyIndex($offset);
            if (is_null($index)) {
                $index = max(array_keys($this->items));
                $this->keys[$offset] = $index;
            }
        } else {
            $index = $offset;
        }

        // Store the value with numeric key
        $this->items[$index] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if (is_string($offset)) {
            $index = $this->keyIndex($offset);
            unset($this->keys[$index]);
            $offset = $index;
        }
        if (isset($this->items[$offset])) {
            unset($this->items[$offset]);
        }
    }

    /**
     * @param $element
     * @param string|null $key
     */
    public function append($element, string $key = null)
    {
        $offset = max(array_keys($this->items));
        if (!is_null($key)) {
            $index = $this->keyIndex($key);
            if (!is_null($index)) { // item with key found
                $this->offsetSet($index, $element);
                return;
            }
            $this->keys[$key] = $offset;
        }
        $this->offsetSet($offset, $element);
    }

    /**
     * @param $element
     * @param string|null $key
     */
    public function prepend($element, string $key = null)
    {
        if (!is_null($key)) {
            $index = $this->keyIndex($key);
            if (!is_null($index)) { // item with key found
                $this->offsetSet($index, $element);
                return;
            }
            $newKeys = [ $key => 0 ];
            // move existing keys one up
            foreach ($this->keys as $ekey => $value) {
                $newKeys[$ekey] = $value + 1;
            }
        }
        array_unshift($this->items, 1);
        $this->offsetSet(0, $element);
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize($this->getArrayCopy());
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $payload = $this->unserialize($serialized);
        $this->exchangeArray($payload);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items) ?? 0;
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $items = $this->items;
        if (count($this->keys) > 0) {
            $items = [];
            $reversed = array_flip($this->keys);
            foreach ($this->items as $offset => $value) {
                $key = isset($reversed[$offset]) ? $reversed[$offset] : $offset;
                $items[$key] = $this->items[$offset];
            }
        }
        return ExtractableHelper::sanitize($items, $options);
    }

    /**
     * @param array $payload
     */
    public function exchangeArray(array $payload)
    {
        foreach ($payload as $offset => $value) {
            $this->offsetSet($offset, $value);
        }
    }

}
