<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Phone;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\ValueObject\PhoneState;

class PhonesForOverview implements Query
{
    /**
     * @var IdentityId|null
     */
    private $identityId;

    /**
     * @var PhoneState|null
     */
    private $state;

    /**
     * @var string|null
     */
    private $provider;

    /**
     * @var string|null
     */
    private $phoneNumber;

    /**
     * PhonesForOverview constructor.
     * @param string|null $provider
     * @param PhoneState|null $state
     * @param IdentityId|null $identityId
     */
    public function __construct(
        ?string $provider = null,
        ?string $phoneNumber = null,
        ?PhoneState $state = null,
        ?IdentityId $identityId = null
    ) {
        $this->provider = $provider;
        $this->phoneNumber = $phoneNumber;
        $this->state = $state;
        $this->identityId = $identityId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'provider' => $this->getProvider(),
            'phone_number' => $this->getPhoneNumber(),
            'state' => $this->getState() ? $this->getState()->scalar() : null,
            'identity_id' => $this->getIdentityId() ? $this->getIdentityId()->scalar() : null,
        ];
    }

    /**
     * @param array $payload
     * @return Query|PhonesForOverview
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            !empty($payload['provider']) ? $payload['provider'] : null,
            !empty($payload['phone_number']) ? $payload['phone_number'] : null,
            !empty($payload['state']) ? PhoneState::fromValue($payload['state']) : null,
            !empty($payload['identity_id']) ? IdentityId::fromValue($payload['identity_id']) : null
        );
    }

    /**
     * @return IdentityId|null
     */
    public function getIdentityId(): ?IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return PhoneState|null
     */
    public function getState(): ?PhoneState
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->provider;
    }
}
