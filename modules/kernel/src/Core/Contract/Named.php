<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Core\Contract;

interface Named
{
    /**
     * The object's name
     *
     * @return string
     */
    public function name(): string;
}
