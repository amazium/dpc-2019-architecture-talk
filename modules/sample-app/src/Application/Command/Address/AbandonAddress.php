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

class AbandonAddress implements Command
{
    /**
     * @var AddressId
     */
    private $addressId;

    /**
     * AbandonAddress constructor.
     * @param AddressId $addressId
     */
    public function __construct(AddressId $addressId)
    {
        $this->addressId = $addressId;
    }

    /**
     * @param array $payload
     * @return Command|void
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
