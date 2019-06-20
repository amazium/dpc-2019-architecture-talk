<?php

namespace Amazium\Kernel\Core\Exception;

use DomainException as BaseDomainException;

/**
 * Exception thrown if a value does not adhere to a defined valid data domain.
 * @link https://php.net/manual/en/class.domainexception.php
 */
class DomainException extends BaseDomainException implements ExtractableException
{
    use MakeExtractable;
}
