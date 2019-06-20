<?php

namespace Amazium\Kernel\Core\Exception;

use LogicException as BaseLogicException;

/**
 * Exception that represents error in the program logic. This kind of
 * exceptions should directly lead to a fix in your code.
 * @link https://php.net/manual/en/class.logicexception.php
 */
class LogicException extends BaseLogicException implements ExtractableException
{
    use MakeExtractable;
}
