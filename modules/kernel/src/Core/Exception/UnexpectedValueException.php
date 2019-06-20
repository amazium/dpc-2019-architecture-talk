<?php

namespace Amazium\Kernel\Core\Exception;

use UnexpectedValueException as BaseUnexpectedValueException;

/**
 * Exception thrown if a value does not match with a set of values. Typically
 * this happens when a function calls another function and expects the return
 * value to be of a certain type or value not including arithmetic or buffer
 * related errors.
 * @link https://php.net/manual/en/class.unexpectedvalueexception.php
 */
class UnexpectedValueException extends BaseUnexpectedValueException implements ExtractableException
{
    use MakeExtractable;
}
