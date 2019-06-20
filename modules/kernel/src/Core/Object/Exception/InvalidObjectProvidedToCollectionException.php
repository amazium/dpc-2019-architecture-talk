<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Object\Exception;

use Amazium\Kernel\Core\Exception\InvalidArgumentException;
use Throwable;

class InvalidObjectProvidedToCollectionException extends InvalidArgumentException
{
    /**
     * @param string $collectionClassName
     * @param string $expectedObjectClassName
     * @param string $actualObjectClassName
     * @param int $code
     * @param Throwable|null $previous
     * @return InvalidObjectProvidedToCollectionException
     */
    public static function withClassNames(
        string $collectionClassName,
        string $expectedObjectClassName,
        string $actualObjectClassName,
        int $code = 0,
        Throwable $previous = null
    ): InvalidObjectProvidedToCollectionException {
        $message = sprintf(
            'Collection %s expects elements of type %s but received one of type %s',
            $collectionClassName,
            $expectedObjectClassName,
            $actualObjectClassName
        );
        return new static($message, $code, $previous);
    }
}
