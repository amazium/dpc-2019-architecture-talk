<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\PhoneId;

class PhoneDetails implements Query
{
    /**
     * @var PhoneId
     */
    private $phoneId;

    /**
     * PhoneDetails constructor.
     * @param PhoneId $phoneId
     */
    public function __construct(PhoneId $phoneId)
    {
        $this->phoneId = $phoneId;
    }

    /**
     * @param array $payload
     * @return Query|PhoneDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            PhoneId::fromValue($payload['phone_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'phone_id' => $this->getPhoneId()->scalar()
        ];
    }

    /**
     * @return PhoneId
     */
    public function getPhoneId(): PhoneId
    {
        return $this->phoneId;
    }
}
