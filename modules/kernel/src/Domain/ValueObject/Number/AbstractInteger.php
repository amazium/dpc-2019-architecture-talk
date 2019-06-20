<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Kernel\Domain\ValueObject\Number;

use Amazium\Kernel\Domain\ValueObject\ValueObject;

class AbstractInteger implements ValueObject
{
    /**
     * @var int
     */
    private $value;

    /**
     * AbstractInteger constructor.
     * @param int $value
     */
    private function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return static
     */
    public static function fromValue($value)
    {
        if (is_null($value)) {
            return null;
        }
        return new static(intval($value));
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public static function isValid($value): bool
    {
        return is_integer($value);
    }

    /**
     * @return mixed|void
     */
    public function scalar()
    {
        return $this->value();
    }

    /**
     * @return int
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return strval($this->value);
    }
}
