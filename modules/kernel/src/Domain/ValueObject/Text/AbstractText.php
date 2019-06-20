<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject\Text;

use Amazium\Kernel\Domain\ValueObject\Exception\InvalidValueException;
use Amazium\Kernel\Domain\ValueObject\ValueObject;

abstract class AbstractText implements ValueObject
{
    /**
     * @var string
     */
    private $value;

    /**
     * AbstractText constructor.
     * @param string $value
     */
    protected function __construct(?string $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    abstract public static function isValid($value): bool;

    /**
     * @return null
     */
    protected static function defaultReturnValue()
    {
        return null;
    }

    /**
     * @param string $value
     * @return static
     * @throws InvalidValueException
     */
    public static function fromValue($value)
    {
        if (empty($value)) {
            return self::defaultReturnValue();
        }
        if (!static::isValid($value)) {
            throw InvalidValueException::withValue(static::class, $value);
        }
        return new static(strval($value));
    }

    /**
     * @return mixed|string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return mixed|string
     */
    public function scalar()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
