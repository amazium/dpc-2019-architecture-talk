<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\SampleApp\Application\Command\BankAccount;

use Amazium\Kernel\Application\Context\Context;

class ModifyBankAccountDetailsHandlerImpl extends AbstractBankAccountHandler implements ModifyBankAccountDetailsHandler
{
    /**
     * @param ModifyBankAccountDetails $modifyBankAccountDetails
     * @param Context $context
     * @return array
     */
    public function handle(ModifyBankAccountDetails $modifyBankAccountDetails, Context $context): array
    {
        $bankAccount = $this->bankAccounts->findById($modifyBankAccountDetails->getBankAccountId());
        $bankAccount->modifyDetails(
            $modifyBankAccountDetails->getAccountNumber(),
            $modifyBankAccountDetails->getNameOnAccount(),
            $modifyBankAccountDetails->getBankName(),
            $modifyBankAccountDetails->getBankAddressLine1(),
            $modifyBankAccountDetails->getBankAddressLine2(),
            $modifyBankAccountDetails->getBankAddressLine3(),
            $modifyBankAccountDetails->getCardAddressId(),
            $modifyBankAccountDetails->getExtraInfo()
        );
        $this->bankAccounts->save($bankAccount);
        return [
            'bank_account_id' => $modifyBankAccountDetails->getBankAccountId()->scalar(),
        ];
    }
}
