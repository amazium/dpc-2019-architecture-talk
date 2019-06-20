<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Context\Context;

class AbandonBankAccountHandlerImpl extends AbstractBankAccountHandler implements AbandonBankAccountHandler
{
    /**
     * @param AbandonBankAccount $abandonBankAccount
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(AbandonBankAccount $abandonBankAccount, Context $context): array
    {
        $bankAccount = $this->bankAccounts->findById($abandonBankAccount->getBankAccountId());
        $bankAccount->abandon();
        $this->bankAccounts->save($bankAccount);
        return [
            'bank_account_id' => $abandonBankAccount->getBankAccountId()->scalar(),
        ];
    }
}
