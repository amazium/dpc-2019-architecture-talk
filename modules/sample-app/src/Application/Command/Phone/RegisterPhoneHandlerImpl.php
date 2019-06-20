<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Aggregate\Phone;

class RegisterPhoneHandlerImpl extends AbstractPhoneHandler implements RegisterPhoneHandler
{
    /**
     * @param RegisterPhone $registerPhone
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(RegisterPhone $registerPhone, Context $context): array
    {
        $phone = Phone::register(
            $registerPhone->getPhoneId(),
            $registerPhone->getIdentityId(),
            $registerPhone->getPhoneNumber(),
            $registerPhone->getProvider(),
            $registerPhone->getPinCode(),
            $registerPhone->getPukCode(),
            $registerPhone->getPuk2Code(),
            $registerPhone->getExtraInfo()
        );
        $this->phones->save($phone);
        return [
            'phone_id' => $registerPhone->getPhoneId()->scalar(),
        ];
    }
}
