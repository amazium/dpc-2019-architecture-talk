<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Context\Context;

class ActivatePhoneHandlerImpl extends AbstractPhoneHandler implements ActivatePhoneHandler
{
    /**
     * @param ActivatePhone $activatePhone
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(ActivatePhone $activatePhone, Context $context): array
    {
        $phone = $this->phones->findById($activatePhone->getPhoneId());
        $phone->activate();
        $this->phones->save($phone);
        return [
            'phone_id' => $activatePhone->getPhoneId()->scalar(),
        ];
    }
}
