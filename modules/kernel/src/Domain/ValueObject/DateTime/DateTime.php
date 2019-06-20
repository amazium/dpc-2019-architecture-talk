<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-28}
 */

namespace Amazium\Kernel\Domain\ValueObject\DateTime;

use Amazium\Kernel\Domain\ValueObject\ValueObject;
use DateTime as StdDateTime;

class DateTime implements ValueObject
{
    /** @var StdDateTime */
    private $value;

    /**
     * DateTime constructor.
     * @param StdDateTime $dateTime
     */
    public function __construct(StdDateTime $dateTime)
    {
        $this->value = $dateTime;
    }

    /**
     * @param string $dateTime
     * @return DateTime
     * @throws \Exception
     */
    public static function fromValue($dateTime = 'now'): DateTime
    {
        if (is_null($dateTime)) {
            $dateTime = 'now';
        }
        return new static(new StdDateTime($dateTime));
    }

    /**
     * @return StdDateTime
     */
    public function value(): StdDateTime
    {
        return $this->value;
    }

    /**
     * @return mixed|string
     */
    public function scalar()
    {
        return $this->value()->format('Y-m-d H:i:s');
    }

    /**
     * @param string $dateTime
     * @return bool
     */
    public static function isValid($dateTime): bool
    {
        return strtotime($dateTime) !== false;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->scalar();
    }
}
