<?php

namespace Amazium\Kernel\Core\Exception;

use Amazium\Kernel\Core\Contract\Extractable;
use Throwable;

interface ExtractableException extends Throwable, Extractable
{
}
