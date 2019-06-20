<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Context\Context;

class ActivateBankAccountHandlerImpl extends AbstractBankAccountHandler implements ActivateBankAccountHandler
{
    /**
     * @param ActivateBankAccount $activateBankAccount
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(ActivateBankAccount $activateBankAccount, Context $context): array
    {
        $bankAccount = $this->bankAccounts->findById($activateBankAccount->getBankAccountId());
        $bankAccount->activate();
        $this->bankAccounts->save($bankAccount);
        return [
            'bank_account_id' => $activateBankAccount->getBankAccountId()->scalar(),
        ];
    }
}
