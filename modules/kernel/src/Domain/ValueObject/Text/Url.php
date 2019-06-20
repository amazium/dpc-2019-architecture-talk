<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject\Text;

class Url extends AbstractText
{
    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }
}
