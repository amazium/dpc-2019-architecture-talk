<?php

namespace Amazium\Kernel\Core\Exception;

use OutOfRangeException as BaseOutOfRangeException;

/**
 * Exception thrown when an illegal index was requested. This represents
 * errors that should be detected at compile time.
 * @link https://php.net/manual/en/class.outofrangeexception.php
 */
class OutOfRangeException extends BaseOutOfRangeException implements ExtractableException
{
    use MakeExtractable;
}
