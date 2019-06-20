<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Context\Context;

class BankAccountsForOverviewFetcherImpl extends AbstractBankAccountFetcher implements BankAccountsForOverviewFetcher
{
    /**
     * @param BankAccountsForOverview $accountsForOverview
     * @param Context $context
     * @return array|mixed
     */
    public function fetch(BankAccountsForOverview $accountsForOverview, Context $context)
    {
        return $this->bankAccounts->fetchAll(
            $accountsForOverview->getBankName(),
            $accountsForOverview->getState(),
            $accountsForOverview->getIdentityId()
        );
    }
}
