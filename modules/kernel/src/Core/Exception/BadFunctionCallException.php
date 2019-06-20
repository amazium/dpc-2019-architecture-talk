<?php

namespace Amazium\Kernel\Core\Exception;

use BadFunctionCallException as BaseBadFunctionCallException;

/**
 * Exception thrown if a callback refers to an undefined function or if some
 * arguments are missing.
 * @link https://php.net/manual/en/class.badfunctioncallexception.php
 */
class BadFunctionCallException extends BaseBadFunctionCallException implements ExtractableException
{
    use MakeExtractable;
}
