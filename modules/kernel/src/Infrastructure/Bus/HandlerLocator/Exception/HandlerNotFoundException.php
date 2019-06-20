<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Infrastructure\Bus\HandlerLocator\Exception;

use Amazium\Kernel\Core\Exception\LogicException;

class HandlerNotFoundException extends LogicException
{
    public static function withHandlerName(
        string $handlerName,
        int $code = 0,
        \Throwable $previous = null
    ): HandlerNotFoundException {
        $message = sprintf(
            'Handler %s not found',
            $handlerName
        );
        return new static($message, $code, $previous);
    }
}
