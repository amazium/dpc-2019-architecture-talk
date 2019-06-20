<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Application\Context;

use Amazium\Kernel\Core\Object\ArrayObject;
use Amazium\Kernel\Core\Contract\Extractable;

class ContextArray extends ArrayObject implements Extractable, Context
{
}
