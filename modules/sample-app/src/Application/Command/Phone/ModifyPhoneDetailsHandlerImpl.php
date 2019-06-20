<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Context\Context;

/**
 * Class ModifyPhoneDetailsHandlerImpl
 * @package Amazium\SampleApp\Application\Command\Phone
 */
class ModifyPhoneDetailsHandlerImpl extends AbstractPhoneHandler implements ModifyPhoneDetailsHandler
{
    /**
     * @param ModifyPhoneDetails $modifyPhoneDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyPhoneDetails $modifyPhoneDetails, Context $context): array
    {
        $phone = $this->phones->findById($modifyPhoneDetails->getPhoneId());
        $phone->modifyDetails(
            $modifyPhoneDetails->getPhoneNumber(),
            $modifyPhoneDetails->getPinCode(),
            $modifyPhoneDetails->getPukCode(),
            $modifyPhoneDetails->getPuk2Code(),
            $modifyPhoneDetails->getExtraInfo()
        );
        $this->phones->save($phone);
        return [
            'phone_id' => $modifyPhoneDetails->getPhoneId()->scalar(),
        ];
    }
}
