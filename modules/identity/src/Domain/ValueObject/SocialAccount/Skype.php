<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\ValueObject\SocialAccount;

use Amazium\Kernel\Domain\ValueObject\Text\AbstractText;

class Skype extends AbstractText
{
    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return preg_match('/^[a-z][a-z0-9\.,\-_]{5,31}$/i', $value);
    }
}
