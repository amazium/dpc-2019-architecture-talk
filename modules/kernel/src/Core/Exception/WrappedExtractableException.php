<?php

namespace Amazium\Kernel\Core\Exception;

use Throwable;

class WrappedExtractableException extends Exception
{
    /**
     * @param Throwable $previous
     * @return ExtractableException
     */
    public static function fromException(Throwable $previous): ExtractableException
    {
        if ($previous instanceof ExtractableException) {
            return $previous;
        }
        return new Exception($previous->getMessage(), $previous->getCode(), $previous);
    }
}
