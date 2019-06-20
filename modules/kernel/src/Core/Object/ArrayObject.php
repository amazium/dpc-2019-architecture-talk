<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Object;

use ArrayAccess;
use ArrayObject as StdArrayObject;
use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Core\Helper\ExtractableHelper;
use Countable;
use IteratorAggregate;
use Serializable;
use Traversable;

class ArrayObject implements Extractable, IteratorAggregate, ArrayAccess, Serializable, Countable
{
    /** @var StdArrayObject */
    private $items;

    /**
     * ArrayObject constructor.
     * @param array $input
     */
    public function __construct(array $input = [])
    {
        $this->exchangeArray($input);
    }

    /**
     * @param array|null $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $payload = $this->items->getArrayCopy();
        return ExtractableHelper::sanitize($payload, $options);
    }

    /**
     * @param array $input
     */
    public function exchangeArray(array $input)
    {
        $this->items = new StdArrayObject([], StdArrayObject::ARRAY_AS_PROPS);
        foreach ($input as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * @return \ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return $this->items->getIterator();
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->items->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->items->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->items->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->items->offsetUnset($offset);
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return $this->items->serialize();
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        $this->items->unserialize($serialized);
    }

    /**
     * @return int
     */
    public function count()
    {
        return $this->items->count();
    }
}
