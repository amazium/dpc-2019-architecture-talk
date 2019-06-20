<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Context\Context;

class AssignAddressToIdentityHandlerImpl extends AbstractAddressHandler implements AssignAddressToIdentityHandler
{
    /**
     * @param AssignAddressToIdentity $assignAddressToIdentity
     * @param Context $context
     * @return array
     */
    public function handle(AssignAddressToIdentity $assignAddressToIdentity, Context $context): array
    {
        $address = $this->addresses->findById($assignAddressToIdentity->getAddressId());
        $address->assignIdentity($assignAddressToIdentity->getIdentityId());
        $this->addresses->save($address);
        return [
            'address_id' => $assignAddressToIdentity->getAddressId()->scalar(),
        ];
    }
}
