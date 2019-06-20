<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Repository;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\Address as AddressModel;
use Amazium\SampleApp\Domain\ValueObject\AddressId;
use Amazium\SampleApp\Domain\ValueObject\AddressState;
use Amazium\SampleApp\Domain\ValueObject\AddressType;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\Repository\Address as AddressRepository;
use Amazium\SampleApp\Infrastructure\Db\Mapper\Address as AddressMapper;
use Zend\Db\Sql\Predicate\IsNull;

class Address implements AddressRepository
{
    /**
     * @var Engine
     */
    private $dbEngine;

    /**
     * Address constructor.
     * @param Engine $dbEngine
     */
    public function __construct(Engine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param AddressModel $address
     * @return bool
     */
    public function save(AddressModel $address): bool
    {
        if ($address->getInternalId()) {
            return $this->dbEngine->update(
                'address',
                AddressMapper::addressModelToTableData($address),
                [ 'id' => $address->getInternalId()->scalar() ]
            ) !== false;
        } else {
            return $this->dbEngine->insert(
                'address',
                AddressMapper::addressModelToTableData($address)
            );
        }
    }

    /**
     * @param AddressId $addressId
     * @return AddressModel|null
     * @throws \Exception
     */
    public function findById(AddressId $addressId): ?AddressModel
    {
        $results = $this->dbEngine->find(
            'address',
            [
                'id' => $addressId->scalar(),
            ]
        );
        if (count($results) === 1) {
            return AddressMapper::tableDataToAddressModel($results[0]);
        }
        return null;
    }

    /**
     * @param AddressId $addressId
     * @return AddressModel|null
     * @throws \Exception
     */
    public function fetchById(AddressId $addressId): ?array
    {
        $results = $this->dbEngine->find('v_address_detail', [ 'address_id' => $addressId->scalar() ]);
        if (count($results) === 1) {
            return $results[0];
        }
        return null;
    }

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
    ): array {
        $where = [];
        if (!is_null($addressType)) {
            $where['address_type'] = $addressType->scalar();
        }
        if (!is_null($country)) {
            $where['country'] = $country;
        }
        if (!is_null($zipcode)) {
            $where['zipcode'] = $zipcode;
        }
        if (!is_null($state)) {
            $where['state'] = $state->scalar();
        }
        if (!is_null($identityId)) {
            $where['identity_id'] = $identityId->scalar();
        }
        return $this->dbEngine->find(
            'v_address_overview',
            $where
        );
    }

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
    ): array {
        $where = [];
        if (!is_null($addressType)) {
            $where['address_type'] = $addressType->scalar();
        }
        if (!is_null($country)) {
            $where['country'] = $country;
        }
        if (!is_null($addressType)) {
            $where['zipcode'] = $zipcode;
        }
        if (!is_null($state)) {
            $where['state'] = $state->scalar();
        }
        $where['identity_id'] = new IsNull('identity_id');
        return $this->dbEngine->find(
            'v_address_overview',
            $where
        );
    }
}
