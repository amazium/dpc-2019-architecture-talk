<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Application\Command;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Core\Contract\CreatableFromArray;

interface Command extends Extractable, CreatableFromArray
{

}
