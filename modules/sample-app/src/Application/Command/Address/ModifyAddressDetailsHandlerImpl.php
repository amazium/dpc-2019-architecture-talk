<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Context\Context;

class ModifyAddressDetailsHandlerImpl extends AbstractAddressHandler implements ModifyAddressDetailsHandler
{
    public function handle(ModifyAddressDetails $modifyAddressDetails, Context $context): array
    {
        $address = $this->addresses->findById($modifyAddressDetails->getAddressId());
        $address->modifyDetails(
            $modifyAddressDetails->getAddressType(),
            $modifyAddressDetails->getBuilding(),
            $modifyAddressDetails->getStreet(),
            $modifyAddressDetails->getNumber(),
            $modifyAddressDetails->getBox(),
            $modifyAddressDetails->getZipcode(),
            $modifyAddressDetails->getCity(),
            $modifyAddressDetails->getRegion(),
            $modifyAddressDetails->getCountry(),
            $modifyAddressDetails->getActiveFrom(),
            $modifyAddressDetails->getActiveUntil(),
            $modifyAddressDetails->getExtraInfo()
        );
        $this->addresses->save($address);
        return [
            'address_id' => $modifyAddressDetails->getAddressId()->scalar(),
        ];
    }
}
