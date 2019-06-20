<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-31}
 */

namespace Amazium\SampleApp\Domain\Aggregate;

use Amazium\Kernel\Core\Contract\Extractable;
use Amazium\Kernel\Domain\Aggregate\AggregateRoot;
use Amazium\Kernel\Domain\ValueObject\DateTime\Date;
use Amazium\Kernel\Domain\ValueObject\Text\Country;
use Amazium\SampleApp\Domain\ValueObject\AddressId;
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class Address implements AggregateRoot
{
    /**
     * @var AddressId
     */
    private $addressId;

    /**
     * @var IdentityId
     */
    private $identityId;

    /**
     * @var AddressType
     */
    private $addressType;

    /**
     * @var AddressState
     */
    private $state;

    /**
     * @var string|null
     */
    private $building;

    /**
     * @var string|null
     */
    private $street;

    /**
     * @var string|null
     */
    private $number;

    /**
     * @var string|null
     */
    private $box;

    /**
     * @var string|null
     */
    private $zipcode;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     */
    private $region;

    /**
     * @var Country|null
     */
    private $country;

    /**
     * @var Date|null
     */
    private $activeFrom;

    /**
     * @var Date|null
     */
    private $activeUntil;

    /**
     * @var array
     */
    private $extraInfo = [];

    /**
     * @var AddressId|null
     */
    private $internalId;

    /**
     * Address constructor.
     * @param AddressId $addressId
     * @param AddressType $addressType
     * @param AddressState $state
     * @param string|null $building
     * @param string|null $street
     * @param string|null $number
     * @param string|null $box
     * @param string|null $zipcode
     * @param string|null $city
     * @param string|null $region
     * @param Country|null $country
     * @param Date|null $activeFrom
     * @param Date|null $activeUntil
     * @param IdentityId|null $identityId
     * @param array $extraInfo
     * @param AddressId|null $internalId
     */
    public function __construct(
        AddressId $addressId,
        AddressType $addressType,
        AddressState $state,
        ?string $building = null,
        ?string $street = null,
        ?string $number = null,
        ?string $box = null,
        ?string $zipcode = null,
        ?string $city = null,
        ?string $region = null,
        ?Country $country = null,
        ?Date $activeFrom = null,
        ?Date $activeUntil = null,
        ?IdentityId $identityId = null,
        array $extraInfo = [],
        ?AddressId $internalId = null
    ) {
        $this->addressId = $addressId;
        $this->addressType = $addressType;
        $this->state = $state;
        $this->building = $building;
        $this->street = $street;
        $this->number = $number;
        $this->box = $box;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->activeFrom = $activeFrom;
        $this->activeUntil = $activeUntil;
        $this->identityId = $identityId;
        $this->extraInfo = $extraInfo;
        $this->internalId = $internalId;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        $return = [
            'address_id' => $this->getAddressId()->scalar(),
            'identity_id' => $this->getIdentityId() ? $this->getIdentityId()->scalar() : null,
            'address_type' => $this->getAddressType() ? $this->getAddressType()->scalar() : null,
            'building' => $this->getBuilding(),
            'street' => $this->getStreet(),
            'number' => $this->getNumber(),
            'box' => $this->getBox(),
            'zipcode' => $this->getZipcode(),
            'city' => $this->getCity(),
            'region' => $this->getRegion(),
            'country' => $this->getCountry() ? $this->getCountry()->scalar() : null,
            'active_from' => $this->getActiveFrom() ? $this->getActiveFrom()->scalar() : null,
            'active_until' => $this->getActiveUntil() ? $this->getActiveUntil()->scalar() : null,
            'extra_info' => $this->getExtraInfo(),
            'state' => $this->getState() ? $this->getState()->scalar() : null,
        ];
        if (empty($options[Extractable::EXTOPT_INCLUDE_IDENTIFIER])) {
            unset($return['internal_id']);
        }
        return $return;
    }

    /**
     * @param array $payload
     * @return AggregateRoot|Address
     * @throws \Exception
     */
    public static function fromArray(array $payload)
    {
        return new static(
            AddressId::fromValue($payload['address_id'] ?? null),
            AddressType::fromValue($payload['address_type'] ?? null),
            AddressState::fromValue($payload['state'] ?? null),
            $payload['building'] ?? null,
            $payload['street'] ?? null,
            $payload['number'] ?? null,
            $payload['box'] ?? null,
            $payload['zipcode'] ?? null,
            $payload['city'] ?? null,
            $payload['region'] ?? null,
            Country::fromValue($payload['country'] ?? null),
            Date::fromValue($payload['active_from'] ?? null),
            Date::fromValue($payload['active_until'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null),
            $payload['extra_info'] ?? [],
            AddressId::fromValue($payload['internal_id'] ?? null)
        );
    }

    /**
     * @return AddressId
     */
    public function getAddressId(): AddressId
    {
        return $this->addressId;
    }

    /**
     * @return IdentityId|null
     */
    public function getIdentityId(): ?IdentityId
    {
        return $this->identityId;
    }

    /**
     * @return AddressType
     */
    public function getAddressType(): AddressType
    {
        return $this->addressType;
    }

    /**
     * @return string|null
     */
    public function getBuilding(): ?string
    {
        return $this->building;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getNumber(): ?string
    {
        return $this->number;
    }

    /**
     * @return string|null
     */
    public function getBox(): ?string
    {
        return $this->box;
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
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return Country|null
     */
    public function getCountry(): ?Country
    {
        return $this->country;
    }

    /**
     * @return Date|null
     */
    public function getActiveFrom(): ?Date
    {
        return $this->activeFrom;
    }

    /**
     * @return Date|null
     */
    public function getActiveUntil(): ?Date
    {
        return $this->activeUntil;
    }

    /**
     * @return AddressState|null
     */
    public function getState(): ?AddressState
    {
        return $this->state;
    }

    /**
     * @return array
     */
    public function getExtraInfo(): array
    {
        return $this->extraInfo;
    }

    /**
     * @return AddressId|null
     */
    public function getInternalId(): ?AddressId
    {
        return $this->internalId;
    }

    /**
     * @param AddressId $addressId
     * @param AddressType $addressType
     * @param string|null $building
     * @param string|null $street
     * @param string|null $number
     * @param string|null $box
     * @param string|null $zipcode
     * @param string|null $city
     * @param string|null $region
     * @param Country|null $country
     * @param Date|null $activeFrom
     * @param Date|null $activeUntil
     * @param IdentityId|null $identityId
     * @param array $extraInfo
     * @return Address
     * @throws \Exception
     */
    public static function create(
        AddressId $addressId,
        AddressType $addressType,
        ?string $building = null,
        ?string $street = null,
        ?string $number = null,
        ?string $box = null,
        ?string $zipcode = null,
        ?string $city = null,
        ?string $region = null,
        ?Country $country = null,
        ?Date $activeFrom = null,
        ?Date $activeUntil = null,
        ?IdentityId $identityId = null,
        array $extraInfo = []
    ): Address {
        return new static(
            $addressId,
            $addressType,
            AddressState::fromValue(AddressState::STATE_PENDING),
            $building,
            $street,
            $number,
            $box,
            $zipcode,
            $city,
            $region,
            $country,
            $activeFrom,
            $activeUntil,
            $identityId,
            $extraInfo
        );
    }

    /**
     * @throws \Exception
     */
    public function activate(): void
    {
        $this->state = AddressState::fromValue(AddressState::STATE_ACTIVE);
    }

    /**
     * @throws \Exception
     */
    public function abandon(): void
    {
        $this->state = AddressState::fromValue(AddressState::STATE_ABANDONED);
    }

    /**
     * @param IdentityId $identityId
     */
    public function assignIdentity(IdentityId $identityId): void
    {
        $this->identityId = $identityId;
    }

    /**
     * @param AddressType $addressType
     * @param string|null $building
     * @param string|null $street
     * @param string|null $number
     * @param string|null $box
     * @param string|null $zipcode
     * @param string|null $city
     * @param string|null $region
     * @param Country|null $country
     * @param Date|null $activeFrom
     * @param Date|null $activeUntil
     * @param array $extraInfo
     */
    public function modifyDetails(
        AddressType $addressType,
        ?string $building = null,
        ?string $street = null,
        ?string $number = null,
        ?string $box = null,
        ?string $zipcode = null,
        ?string $city = null,
        ?string $region = null,
        ?Country $country = null,
        ?Date $activeFrom = null,
        ?Date $activeUntil = null,
        array $extraInfo = []
    ): void {
        $this->addressType = $addressType;
        $this->building = $building;
        $this->street = $street;
        $this->number = $number;
        $this->box = $box;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->activeFrom = $activeFrom;
        $this->activeUntil = $activeUntil;
        $this->extraInfo = $extraInfo;
    }
}
