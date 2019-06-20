<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\Aggregate;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Core\Contract\CreatableFromArray;

interface AggregateRoot extends Extractable, CreatableFromArray
{

}
