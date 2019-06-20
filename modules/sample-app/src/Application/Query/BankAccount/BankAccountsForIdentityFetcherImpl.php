<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Context\Context;

class BankAccountsForIdentityFetcherImpl extends AbstractBankAccountFetcher implements BankAccountsForIdentityFetcher
{
    /**
     * @param BankAccountsForIdentity $bankAccountsForIdentity
     * @param Context $context
     * @return array|mixed
     */
    public function fetch(BankAccountsForIdentity $bankAccountsForIdentity, Context $context)
    {
        return $this->bankAccounts->fetchAll(
            $bankAccountsForIdentity->getBankName(),
            $bankAccountsForIdentity->getState(),
            $bankAccountsForIdentity->getIdentityId()
        );
    }
}
