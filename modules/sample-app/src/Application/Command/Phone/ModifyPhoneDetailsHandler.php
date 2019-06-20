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

interface ModifyPhoneDetailsHandler extends CommandHandler
{
    /**
     * @param ModifyPhoneDetails $modifyPhoneDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyPhoneDetails $modifyPhoneDetails, Context $context): array;
}
