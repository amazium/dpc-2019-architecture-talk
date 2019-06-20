<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Core\Contract;

interface Extractable
{
    /**
     * Do we need to exclude null values from the returned array
     */
    const EXTOPT_INCLUDE_NULL_VALUES = 'INCLUDE_NULL_VALUES';

    /**
     * Do we need to include the identifier from the returned items
     */
    const EXTOPT_INCLUDE_IDENTIFIER  = 'INCLUDE_IDENTIFIER';

    /**
     * Do we need to keep passwords unmasked
     */
    const EXTOPT_UNMASKED_PASSWORD  = 'UNMASKED_PASSWORD';

    /**
     * Get an array representation of the object
     *
     * @param array|null $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array;
}
