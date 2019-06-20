<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Address;

use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface ActivateAddressHandler extends CommandHandler
{
    /**
     * @param ActivateAddress $activateAddress
     * @param Context $context
     * @return array
     */
    public function handle(ActivateAddress $activateAddress, Context $context): array;
}
