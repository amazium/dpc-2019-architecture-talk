<?php

namespace Amazium\Kernel\Core\Exception;

use Exception as BaseException;

/**
 * Exception is the base class for
 * all Exceptions.
 * @link https://php.net/manual/en/class.exception.php
 */
class Exception extends BaseException implements ExtractableException
{
    use MakeExtractable;
}
