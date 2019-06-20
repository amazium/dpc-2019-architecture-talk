<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Command\Command;
use Amazium\SampleApp\Domain\ValueObject\PhoneId;

class AbandonPhone implements Command
{
    /**
     * @var PhoneId
     */
    private $phoneId;

    /**
     * AbandonAddress constructor.
     * @param PhoneId $phoneId
     */
    public function __construct(PhoneId $phoneId)
    {
        $this->phoneId = $phoneId;
    }

    /**
     * @param array $payload
     * @return Command|void
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
