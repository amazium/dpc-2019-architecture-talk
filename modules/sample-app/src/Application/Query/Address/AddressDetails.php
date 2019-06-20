<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\Address;

use Amazium\Kernel\Application\Query\Query;
use Amazium\SampleApp\Domain\ValueObject\AddressId;

class AddressDetails implements Query
{
    /**
     * @var AddressId
     */
    private $addressId;

    /**
     * AddressDetails constructor.
     * @param AddressId $addressId
     */
    public function __construct(AddressId $addressId)
    {
        $this->addressId = $addressId;
    }

    /**
     * @param array $payload
     * @return Query|AddressDetails
     */
    public static function fromArray(array $payload)
    {
        return new static(
            AddressId::fromValue($payload['address_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'address_id' => $this->getAddressId()->scalar()
        ];
    }

    /**
     * @return AddressId
     */
    public function getAddressId(): AddressId
    {
        return $this->addressId;
    }
}
