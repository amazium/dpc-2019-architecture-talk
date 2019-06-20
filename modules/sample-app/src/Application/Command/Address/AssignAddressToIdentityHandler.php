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

interface AssignAddressToIdentityHandler extends CommandHandler
{
    /**
     * @param AssignAddressToIdentity $assignAddressToIdentity
     * @param Context $context
     * @return array
     */
    public function handle(AssignAddressToIdentity $assignAddressToIdentity, Context $context): array;
}
