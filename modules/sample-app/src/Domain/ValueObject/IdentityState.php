<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class IdentityState extends Enum
{
    const STATE_COLLECTING_INFORMATION = 'COLLECTING_INFORMATION';
    const STATE_ACTIVE = 'ACTIVE';
    const STATE_ABANDONED = 'ABANDONED';

    public static $states = [
        self::STATE_COLLECTING_INFORMATION => 'Collecting Information',
        self::STATE_ACTIVE => 'Active',
        self::STATE_ABANDONED => 'Abandoned',
    ];

    /**
     * @return array
     */
    public static function possibleValues(): array
    {
        return array_keys(self::$states);
    }

    /**
     * @return string
     */
    public static function defaultValue()
    {
        return self::STATE_COLLECTING_INFORMATION;
    }
}
