<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Core\Contract;

interface Hydratable
{
    /**
     * Load the data in the object
     *
     * @param array $payload
     * @return mixed
     */
    public function exchangeArray(array $payload);
}
