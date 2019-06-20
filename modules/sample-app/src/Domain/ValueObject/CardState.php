<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class CardState extends Enum
{
    const STATE_REQUESTED = 'REQUESTED';
    const STATE_ACTIVE = 'ACTIVE';
    const STATE_ABANDONED = 'ABANDONED';

    public static $states = [
        self::STATE_REQUESTED => 'Requested',
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
        return self::STATE_REQUESTED;
    }
}
