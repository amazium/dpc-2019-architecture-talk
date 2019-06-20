<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Identity;

use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface CreateIdentityHandler extends CommandHandler
{
    /**
     * @param CreateIdentity $createIdentity
     * @param Context $context
     * @return array
     */
    public function handle(CreateIdentity $createIdentity, Context $context): array;
}
