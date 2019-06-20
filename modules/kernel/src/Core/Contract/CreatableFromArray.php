<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Core\Contract;

interface CreatableFromArray
{
    /**
     * Create a new instance from an array
     *
     * @param array $payload
     * @return static
     */
    public static function fromArray(array $payload);
}
