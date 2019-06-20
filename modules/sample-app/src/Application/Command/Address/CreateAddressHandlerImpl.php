<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Aggregate\Address;

class CreateAddressHandlerImpl extends AbstractAddressHandler implements CreateAddressHandler
{
    /**
     * @param CreateAddress $createAddress
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(CreateAddress $createAddress, Context $context): array
    {
        $address = Address::create(
            $createAddress->getAddressId(),
            $createAddress->getAddressType(),
            $createAddress->getBuilding(),
            $createAddress->getStreet(),
            $createAddress->getNumber(),
            $createAddress->getBox(),
            $createAddress->getZipcode(),
            $createAddress->getCity(),
            $createAddress->getRegion(),
            $createAddress->getCountry(),
            $createAddress->getActiveFrom(),
            $createAddress->getActiveUntil(),
            $createAddress->getIdentityId(),
            $createAddress->getExtraInfo()
        );
        $this->addresses->save($address);
        return [
            'address_id' => $createAddress->getAddressId()->scalar(),
        ];
    }
}
