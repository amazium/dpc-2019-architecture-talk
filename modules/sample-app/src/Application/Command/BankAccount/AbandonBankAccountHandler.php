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

interface AbandonBankAccountHandler extends CommandHandler
{
    /**
     * @param AbandonBankAccount $abandonBankAccount
     * @param Context $context
     * @return array
     */
    public function handle(AbandonBankAccount $abandonBankAccount, Context $context): array;
}
