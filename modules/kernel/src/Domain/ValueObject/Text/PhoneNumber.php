<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\Kernel\Domain\ValueObject\Text;

class PhoneNumber extends AbstractText
{
    /**
     * PhoneNumber constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        parent::__construct(self::filter($text));
    }

    /**
     * @param string $value
     * @return string
     */
    public static function filter(string $value): string
    {
        return preg_replace('/[^\+0-9]/', '', $value);
    }

    /**
     * @param $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return preg_match("/^\+[0-9]*$/", $value);
    }
}
