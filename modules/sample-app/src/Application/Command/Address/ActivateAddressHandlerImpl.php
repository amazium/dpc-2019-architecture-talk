<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Context\Context;

class ActivateAddressHandlerImpl extends AbstractAddressHandler implements ActivateAddressHandler
{
    /**
     * @param ActivateAddress $activateAddress
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(ActivateAddress $activateAddress, Context $context): array
    {
        $address = $this->addresses->findById($activateAddress->getAddressId());
        $address->activate();
        $this->addresses->save($address);
        return [
            'address_id' => $activateAddress->getAddressId()->scalar(),
        ];
    }
}
