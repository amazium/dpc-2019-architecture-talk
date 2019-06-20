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

interface ActivateCardHandler extends CommandHandler
{
    /**
     * @param ActivateCard $activateCard
     * @param Context $context
     * @return array
     */
    public function handle(ActivateCard $activateCard, Context $context): array;
}
