<?php

namespace Amazium\Kernel\Core\Exception;

use OverflowException as BaseOverflowException;

/**
 * Exception thrown when you add an element into a full container.
 * @link https://php.net/manual/en/class.overflowexception.php
 */
class OverflowException extends BaseOverflowException implements ExtractableException
{
    use MakeExtractable;
}
