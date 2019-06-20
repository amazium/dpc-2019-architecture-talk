<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Context\Context;

class AbandonPhoneHandlerImpl extends AbstractPhoneHandler implements AbandonPhoneHandler
{
    /**
     * @param AbandonPhone $abandonPhone
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(AbandonPhone $abandonPhone, Context $context): array
    {
        $phone = $this->phones->findById($abandonPhone->getPhoneId());
        $phone->abandon();
        $this->phones->save($phone);
        return [
            'phone_id' => $abandonPhone->getPhoneId()->scalar(),
        ];
    }
}
