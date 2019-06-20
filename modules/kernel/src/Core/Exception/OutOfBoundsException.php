<?php

namespace Amazium\Kernel\Core\Exception;

use OutOfBoundsException as BaseOutOfBoundsException;

/**
 * Exception thrown if a value is not a valid key. This represents errors
 * that cannot be detected at compile time.
 * @link https://php.net/manual/en/class.outofboundsexception.php
 */
class OutOfBoundsException extends BaseOutOfBoundsException implements ExtractableException
{
    use MakeExtractable;
}
