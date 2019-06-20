<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject;

interface ValueObject
{
    /**
     * @param mixed $value
     * @return static
     */
    public static function fromValue($value);

    /**
     * @return mixed
     */
    public function value();

    /**
     * @return mixed
     */
    public function scalar();

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool;
}
