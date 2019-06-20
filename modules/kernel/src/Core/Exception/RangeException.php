<?php

namespace Amazium\Kernel\Core\Exception;

use RangeException as BaseRangeException;

/**
 * Exception thrown to indicate range errors during program execution.
 * Normally this means there was an arithmetic error other than
 * under/overflow. This is the runtime version of
 * <b>DomainException</b>.
 * @link https://php.net/manual/en/class.rangeexception.php
 */
class RangeException extends BaseRangeException implements ExtractableException
{
    use MakeExtractable;
}
