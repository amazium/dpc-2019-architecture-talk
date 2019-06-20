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

interface AbandonIdentityHandler extends CommandHandler
{
    /**
     * @param AbandonIdentity $abandonIdentity
     * @param Context $context
     * @return array
     */
    public function handle(AbandonIdentity $abandonIdentity, Context $context): array;
}
