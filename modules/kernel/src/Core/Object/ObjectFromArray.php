<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Object;

use Amazium\Kernel\Core\Contract\CreatableFromArray;
use Amazium\Kernel\Core\Object\Exception\ObjectCannotBeCreatedFromArrayException;

class ObjectFromArray
{
    /**
     * @param string $elementClass
     * @return bool
     */
    public static function canCreateUsingAnArray(string $elementClass): bool
    {
        $interfaces = class_implements($elementClass);
        return in_array(CreatableFromArray::class, $interfaces);
    }

    /**
     * @param string $elementClass
     * @param array $payload
     * @return mixed|null
     * @throws ObjectCannotBeCreatedFromArrayException
     */
    public static function createFromArray(string $elementClass, array $payload)
    {
        if (!self::canCreateUsingAnArray($elementClass)) {
            throw ObjectCannotBeCreatedFromArrayException::withClassName($elementClass);
        }
        $interfaces = class_implements($elementClass);
        if (in_array(CreatableFromArray::class, $interfaces)) {
            return call_user_func([ $elementClass, 'fromArray' ], $payload);
        }
        return null;
    }
}
