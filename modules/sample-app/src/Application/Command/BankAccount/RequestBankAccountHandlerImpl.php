<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Context\Context;
use Amazium\SampleApp\Domain\Aggregate\BankAccount;

class RequestBankAccountHandlerImpl extends AbstractBankAccountHandler implements RequestBankAccountHandler
{
    /**
     * @param RequestBankAccount $requestBankAccount
     * @param Context $context
     * @return array
     * @throws \Exception
     */
    public function handle(RequestBankAccount $requestBankAccount, Context $context): array
    {
        $bankAccount = BankAccount::request(
            $requestBankAccount->getBankAccountId(),
            $requestBankAccount->getIdentityId(),
            $requestBankAccount->getAccountNumber(),
            $requestBankAccount->getNameOnAccount(),
            $requestBankAccount->getBankName(),
            $requestBankAccount->getBankAddressLine1(),
            $requestBankAccount->getBankAddressLine2(),
            $requestBankAccount->getBankAddressLine3(),
            $requestBankAccount->getCardAddressId(),
            $requestBankAccount->getExtraInfo()
        );
        $this->bankAccounts->save($bankAccount);
        return [
            'bank_account_id' => $requestBankAccount->getBankAccountId()->scalar(),
        ];
    }
}
