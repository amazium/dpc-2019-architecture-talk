<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Command\Command;
use Amazium\SampleApp\Domain\ValueObject\AddressId;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class AssignAddressToIdentity implements Command
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
     * ActivateAddress constructor.
     * @param AddressId $addressId
     * @param IdentityId $identityId
     */
    public function __construct(AddressId $addressId, IdentityId $identityId)
    {
        $this->addressId = $addressId;
        $this->identityId = $identityId;
    }

    /**
     * @param array $payload
     * @return Command|void
     */
    public static function fromArray(array $payload)
    {
        return new static(
            AddressId::fromValue($payload['address_id'] ?? null),
            IdentityId::fromValue($payload['identity_id'] ?? null)
        );
    }

    /**
     * @param array $options
     * @return array
     */
    public function getArrayCopy(array $options = []): array
    {
        return [
            'address_id' => $this->getAddressId()->scalar(),
            'identity_id' => $this->getAddressId()->scalar()
        ];
    }

    /**
     * @return AddressId
     */
    public function getAddressId(): AddressId
    {
        return $this->addressId;
    }

    /**
     * @return IdentityId
     */
    public function getIdentityId(): IdentityId
    {
        return $this->identityId;
    }
}
