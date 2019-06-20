<?php

namespace Amazium\Kernel\Core\Exception;

use InvalidArgumentException as BaseInvalidArgumentException;
use Throwable;

/**
 * Exception thrown if an argument does not match with the expected value.
 * @link https://php.net/manual/en/class.invalidargumentexception.php
 */
class InvalidArgumentException extends BaseInvalidArgumentException implements ExtractableException
{
    use MakeExtractable;

    /**
     * @param string $className
     * @param string $paramName
     * @param string $expectedType
     * @param string $actualType
     * @param int $code
     * @param Throwable|null $previous
     * @return InvalidArgumentException
     */
    public static function withParamNameExpectedAndActualType(
        string $className,
        string $paramName,
        string $expectedType,
        string $actualType,
        int $code = 0,
        Throwable $previous = null
    ): InvalidArgumentException {
        return new static(
            sprintf(
                '%s expected %s to be of type %s, but got %s',
                $className,
                $paramName,
                $expectedType,
                $actualType
            ),
            $code,
            $previous
        );
    }
}
