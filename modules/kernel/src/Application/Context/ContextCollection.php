<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Application\Context;

use Amazium\Kernel\Core\Object\Collection;

class ContextCollection extends Collection implements Context
{
    /**
     * @return string
     */
    public static function elementClass(): string
    {
        return Context::class;
    }
}
