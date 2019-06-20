<?php

namespace Amazium\Kernel\Core\Exception;

use LengthException as BaseLengthException;

/**
 * Exception thrown if a length is invalid.
 * @link https://php.net/manual/en/class.lengthexception.php
 */
class LengthException extends BaseLengthException implements ExtractableException
{
    use MakeExtractable;
}
