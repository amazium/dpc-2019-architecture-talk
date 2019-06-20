<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\Card;

use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface ModifyCardDetailsHandler extends CommandHandler
{
    /**
     * @param ModifyCardDetails $modifyCardDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyCardDetails $modifyCardDetails, Context $context): array;
}
