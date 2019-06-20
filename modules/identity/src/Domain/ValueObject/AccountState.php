<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class AccountState extends Enum
{
    const REGISTERED = 'REGISTERED';
    const PENDING_ACTIVATION = 'PENDING_ACTIVATION';
    const ACTIVE = 'ACTIVE';
    const DEACTIVATED = 'DEACTIVATED';
    const BANNED = 'BANNED';
    const DELETED = 'DELETED';

    /**
     * @return string
     */
    public static function defaultValue()
    {
        return self::REGISTERED;
    }

    /**
     * @return array
     */
    public static function possibleValues(): array
    {
        return [
            self::REGISTERED,
            self::PENDING_ACTIVATION,
            self::ACTIVE,
            self::DEACTIVATED,
            self::BANNED,
            self::DELETED,
        ];
    }
}
