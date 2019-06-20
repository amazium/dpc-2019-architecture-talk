<?php

namespace Amazium\Kernel\Core\Exception;

use RuntimeException as BaseRuntimeException;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 * @link https://php.net/manual/en/class.runtimeexception.php
 */
class RuntimeException extends BaseRuntimeException implements ExtractableException
{
    use MakeExtractable;
}
