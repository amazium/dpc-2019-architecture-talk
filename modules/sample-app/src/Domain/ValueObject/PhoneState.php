<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class PhoneState extends Enum
{
    const STATE_PENDING_ACTIVATION = 'PENDING_ACTIVATION';
    const STATE_ACTIVE = 'ACTIVE';
    const STATE_ABANDONED = 'ABANDONED';

    public static $states = [
        self::STATE_PENDING_ACTIVATION => 'Waiting activation',
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
        return self::STATE_PENDING_ACTIVATION;
    }
}
