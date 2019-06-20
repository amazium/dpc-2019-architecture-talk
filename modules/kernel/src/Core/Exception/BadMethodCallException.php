<?php

namespace Amazium\Kernel\Core\Exception;

use BadMethodCallException as BaseBadMethodCallException;

/**
 * Exception thrown if a callback refers to an undefined method or if some
 * arguments are missing.
 * @link https://php.net/manual/en/class.badmethodcallexception.php
 */
class BadMethodCallException extends BaseBadMethodCallException implements ExtractableException
{
    use MakeExtractable;
}
