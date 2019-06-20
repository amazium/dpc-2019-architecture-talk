<?php

namespace Amazium\Kernel\Core\Exception;

use UnderflowException as BaseUnderflowException;

/**
 * Exception thrown when you try to remove an element of an empty container.
 * @link https://php.net/manual/en/class.underflowexception.php
 */
class UnderflowException extends BaseUnderflowException implements ExtractableException
{
    use MakeExtractable;
}
