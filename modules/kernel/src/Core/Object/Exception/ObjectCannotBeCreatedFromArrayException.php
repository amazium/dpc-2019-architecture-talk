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

class ObjectCannotBeCreatedFromArrayException extends InvalidArgumentException
{
    /**
     * @param string $className
     * @param int $code
     * @param \Throwable|null $previous
     * @return ObjectCannotBeCreatedFromArrayException
     */
    public static function withClassName(
        string $className,
        int $code = 0,
        Throwable $previous = null
    ): ObjectCannotBeCreatedFromArrayException {
        $message = sprintf(
            'An instance of %s can not be created from an array',
            $className
        );
        return new static($message, $code, $previous);
    }
}
