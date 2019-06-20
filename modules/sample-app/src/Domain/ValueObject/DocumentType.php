<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\ValueObject;

use Amazium\Kernel\Domain\ValueObject\Enum;

class DocumentType extends Enum
{
    const TYPE_IDCARD_FRONT = 'IDCARD_FRONT';
    const TYPE_IDCARD_BACK = 'IDCARD_BACK';
    const TYPE_PASSPORT = 'PASSPORT';
    const TYPE_DRIVER_LICENSE_FRONT = 'DRIVER_LICENSE_FRONT';
    const TYPE_DRIVER_LICENSE_BACK = 'DRIVER_LICENSE_BACK';
    const TYPE_TAX_RETURN = 'TAX_RETURN';
    const TYPE_SALARY_SLIP = 'SALARY_SLIP';
    const TYPE_BANK_CARD_FRONT = 'BANK_CARD_FRONT';
    const TYPE_BANK_CARD_BACK = 'BANK_CARD_BACK';
    const TYPE_BANK_STATEMENT = 'BANK_STATEMENT';
    const TYPE_CARD_STATEMENT = 'CARD_STATEMENT';
    const TYPE_UTILITY_BILL = 'UTILITY_BILL';

    public static $types = [
        self::TYPE_IDCARD_FRONT => 'ID Card (front)',
        self::TYPE_IDCARD_BACK => 'ID Card (back)',
        self::TYPE_PASSPORT => 'PAssport',
        self::TYPE_DRIVER_LICENSE_FRONT => 'Driver License (Front)',
        self::TYPE_DRIVER_LICENSE_BACK => 'Driver License (Back)',
        self::TYPE_TAX_RETURN => 'Tax Return',
        self::TYPE_SALARY_SLIP => 'Salary Slip',
        self::TYPE_BANK_CARD_FRONT => 'Bank Card (front)',
        self::TYPE_BANK_CARD_BACK => 'Bank Card (back)',
        self::TYPE_BANK_STATEMENT => 'Bank Statement',
        self::TYPE_CARD_STATEMENT => 'Card Statement',
        self::TYPE_UTILITY_BILL => 'Utility Bill',
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
