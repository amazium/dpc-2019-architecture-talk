<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Command\CommandHandler;
use Amazium\Kernel\Application\Context\Context;

interface ActivateBankAccountHandler extends CommandHandler
{
    /**
     * @param ActivateBankAccount $activateBankAccount
     * @param Context $context
     * @return array
     */
    public function handle(ActivateBankAccount $activateBankAccount, Context $context): array;
}
