<?php
/**
 * Amzium: Kernel
 *
 * @copyright Amzium bvba
 * @since {2019-02-26}
 */

namespace Amazium\Kernel\Core\Helper;

use Amazium\Kernel\Core\Contract\Extractable;

class ExtractableHelper
{
    public static function sanitize(array $payload, array $options = []): array
    {
        // Filter out null values
        if (!isset($options[Extractable::EXTOPT_INCLUDE_NULL_VALUES])
            || $options[Extractable::EXTOPT_INCLUDE_NULL_VALUES] === false
        ) {
            $filtered = array_filter(
                $payload,
                function ($value, $key) {
                    return !is_null($value);
                },
                ARRAY_FILTER_USE_BOTH
            );
        }

        // Extract extractables
        $extracted = array_map(
            function ($value) use ($options) {
                if ($value instanceof Extractable) {
                    return $value->getArrayCopy($options);
                }
                return $value;
            },
            $filtered
        );

        return $extracted;
    }
}
