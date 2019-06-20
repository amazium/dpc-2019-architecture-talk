<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Context\Context;

class AbandonAddressHandlerImpl extends AbstractAddressHandler implements AbandonAddressHandler
{
    /**
     * @param AbandonAddress $abandonAddress
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(AbandonAddress $abandonAddress, Context $context): array
    {
        $address = $this->addresses->findById($abandonAddress->getAddressId());
        $address->abandon();
        $this->addresses->save($address);
        return [
            'address_id' => $abandonAddress->getAddressId()->scalar(),
        ];
    }
}
