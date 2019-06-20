<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Repository;

use Amazium\Kernel\Domain\Repository\Repository;
use Amazium\SampleApp\Domain\Aggregate\Address as AddressModel;
use Amazium\SampleApp\Domain\ValueObject\AddressId;
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

interface Address extends Repository
{
    /**
     * @param AddressModel $address
     * @return bool
     */
    public function save(AddressModel $address): bool;

    /**
     * @param AddressId $addressId
     * @return AddressModel|null
     */
    public function findById(AddressId $addressId): ?AddressModel;

    /**
     * @param AddressId $addressId
     * @return AddressModel|null
     */
    public function fetchById(AddressId $addressId): ?array;

    /**
     * @param AddressType|null $addressType
     * @param string|null $country
     * @param string|null $zipcode
     * @param AddressState|null $state
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(
        ?AddressType $addressType = null,
        ?string $country = null,
        ?string $zipcode = null,
        ?AddressState $state = null,
        ?IdentityId $identityId = null
    ): array;

    /**
     * @param AddressType|null $addressType
     * @param string|null $country
     * @param string|null $zipcode
     * @param AddressState|null $state
     * @return array
     */
    public function fetchAllWithoutIdentity(
        ?AddressType $addressType = null,
        ?string $country = null,
        ?string $zipcode = null,
        ?AddressState $state = null
    ): array;
}
