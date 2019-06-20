<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject;

abstract class Enum implements ValueObject
{
    /** @var string */
    private $value;

    abstract public static function defaultValue();

    abstract public static function possibleValues(): array;

    /**
     * Enum constructor.
     * @param $value
     * @throws \Exception
     */
    private function __construct($value)
    {
        if (is_null($value)) {
            $value = static::defaultValue();
        }
        if (!in_array($value, static::possibleValues())) {
            throw new \Exception(sprintf('%s is not a valid value!', $value));
        }
        $this->value = $value;
    }

    /**
     * @param $value
     * @return static
     * @throws \Exception
     */
    public static function fromValue($value)
    {
        return new static($value);
    }

    /**
     * @return mixed|string
     */
    public function scalar()
    {
        return $this->value();
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return in_array($value, static::possibleValues());
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->value;
    }
}
