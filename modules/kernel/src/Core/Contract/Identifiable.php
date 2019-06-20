<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Core\Contract;

interface Identifiable
{
    /**
     * The object identifier
     *
     * @return int|string
     */
    public function id();
}
