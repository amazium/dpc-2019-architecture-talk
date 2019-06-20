<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject\Text;

use Ramsey\Uuid\Uuid;

class Identifier extends AbstractText
{
    /**
     * @return Identifier|null
     * @throws \Exception
     */
    public static function defaultReturnValue()
    {
        return static::generate();
    }

    /**
     * @return static
     * @throws \Exception
     */
    public static function generate()
    {
        return new static(Uuid::uuid4()->toString());
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return Uuid::isValid($value);
    }
}
