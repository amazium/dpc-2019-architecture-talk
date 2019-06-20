<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Phone;

use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface RegisterPhoneHandler extends CommandHandler
{
    /**
     * @param RegisterPhone $registerPhone
     * @param Context $context
     * @return array
     */
    public function handle(RegisterPhone $registerPhone, Context $context): array;
}
