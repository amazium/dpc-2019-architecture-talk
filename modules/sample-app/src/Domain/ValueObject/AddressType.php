<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class AddressType extends Enum
{
    const TYPE_PRIMARY = 'PRIMARY_ADDRESS';
    const TYPE_ADDITIONAL = 'ADDITIONAL_ADDRESS';
    const TYPE_POSTBOX = 'POSTBOX';
    const TYPE_FORWARDING = 'FORWARDING_ADDRESS';

    public static $addressTypes = [
        self::TYPE_PRIMARY    => 'Primary address',
        self::TYPE_ADDITIONAL => 'Additional address',
        self::TYPE_POSTBOX    => 'Postbox',
        self::TYPE_FORWARDING => 'Forwarding address',
    ];

    /**
     * @return array
     */
    public static function possibleValues(): array
    {
        return array_keys(self::$addressTypes);
    }

    /**
     * @return string
     */
    public static function defaultValue()
    {
        return self::TYPE_PRIMARY;
    }
}
