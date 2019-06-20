<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\ValueObject\SocialAccount;

use Amazium\Kernel\Domain\ValueObject\Text\AbstractText;

class Twitter extends AbstractText
{
    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return preg_match('/^@([a-z0-9_]{1,15})$/i', $value);
    }
}
