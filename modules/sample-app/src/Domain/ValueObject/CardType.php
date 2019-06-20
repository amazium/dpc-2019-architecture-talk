<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class CardType extends Enum
{
    const TYPE_DEBIT = 'DEBIT';
    const TYPE_VISA = 'VISA';
    const TYPE_MASTERCARD = 'MASTERCARD';
    const TYPE_AMEX = 'AMEX';

    public static $types = [
        self::TYPE_DEBIT => 'Debit Card',
        self::TYPE_MASTERCARD => 'MasterCard',
        self::TYPE_VISA => 'VISA',
        self::TYPE_AMEX => 'American Express',
    ];

    /**
     * @return array
     */
    public static function possibleValues(): array
    {
        return array_keys(self::$types);
    }

    /**
     * @return |null
     */
    public static function defaultValue()
    {
        return null;
    }
}
