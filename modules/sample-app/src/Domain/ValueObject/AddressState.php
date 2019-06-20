<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class AddressState extends Enum
{
    const STATE_PENDING = 'PENDING';
    const STATE_ACTIVE = 'ACTIVE';
    const STATE_ABANDONED = 'ABANDONED';

    /**
     * @var array
     */
    public static $states = [
        self::STATE_PENDING => 'Pending activation',
        self::STATE_ACTIVE => 'Active',
        self::STATE_ABANDONED => 'Abandoned',
    ];

    /**
     * @return array
     */
    public static function possibleValues(): array
    {
        return array_keys(static::$states);
    }

    /**
     * @return string
     */
    public static function defaultValue()
    {
        return self::STATE_PENDING;
    }
}
