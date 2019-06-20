<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject\Exception;

use Amazium\Kernel\Core\Exception\LogicException;

class InvalidValueException extends LogicException
{
    /**
     * @param string $valueObjectName
     * @param mixed $value
     * @param int $code
     * @param \Throwable|null $previous
     * @return InvalidValueException
     */
    public static function withValue(
        string $valueObjectName,
        $value,
        int $code = 0,
        \Throwable $previous = null
    ): InvalidValueException {
        $message = sprintf(
            '%s received an invalid value: %s',
            $valueObjectName,
            var_export($value, true)
        );
        return new static($message, $code, $previous);
    }
}
