<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class AddressesForOverview implements Query
{
    /**
     * @var IdentityId|null
     */
    private $identityId;

    /**
     * @var AddressState|null
     */
    private $state;

    /**
     * @var AddressType|null
     */
    private $addressType;

    /**
     * @var string|null
     */
    private $zipcode;

    /**
     * @var string|null
     */
    private $country;

    /**
     * AddressesForOverview constructor.
     * @param AddressType|null $addressType
     * @param string|null $country
     * @param string|null $zipcode
     * @param AddressState|null $state
     * @param IdentityId|null $identityId
     */
    public function __construct(
        ?AddressType $addressType = null,
        ?string $country = null,
        ?string $zipcode = null,
        ?AddressState $state = null,
        ?IdentityId $identityId = null
    ) {
        $this->addressType = $addressType;
        $this->country = $country;
        $this->zipcode = $zipcode;
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
            'address_type' => $this->getAddressType() ? $this->getAddressType()->scalar() : null,
            'zipcode' => $this->getZipcode(),
            'country' => $this->getCountry(),
            'state' => $this->getState() ? $this->getState()->scalar() : null,
            'identity_id' => $this->getIdentityId() ? $this->getIdentityId()->scalar() : null,
        ];
    }

    /**
     * @param array $payload
     * @return Query|AddressesForOverview
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            empty($payload['address_type']) ? null : AddressType::fromValue($payload['address_type']),
            empty($payload['country']) ? null : $payload['country'],
            empty($payload['zipcode']) ? null : $payload['zipcode'],
            empty($payload['state']) ? null : AddressState::fromValue($payload['state']),
            empty($payload['identity_id']) ? null : IdentityId::fromValue($payload['identity_id'])
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
     * @return AddressState|null
     */
    public function getState(): ?AddressState
    {
        return $this->state;
    }

    /**
     * @return AddressType|null
     */
    public function getAddressType(): ?AddressType
    {
        return $this->addressType;
    }

    /**
     * @return string|null
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }
}
