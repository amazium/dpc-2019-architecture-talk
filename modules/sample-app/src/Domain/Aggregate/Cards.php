<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Aggregate;

use Amazium\Kernel\Core\Object\Collection;

class Cards extends Collection
{
    /**
     * @return string
     */
    public static function elementClass(): string
    {
        return Card::class;
    }
}
