<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Context\Context;

class BankAccountDetailsFetcherImpl extends AbstractBankAccountFetcher implements BankAccountDetailsFetcher
{
    /**
     * @param BankAccountDetails $bankAccountDetails
     * @param Context $context
     * @return \Amazium\SampleApp\Domain\Aggregate\BankAccount|mixed|null
     */
    public function fetch(BankAccountDetails $bankAccountDetails, Context $context)
    {
        return $this->bankAccounts->fetchById($bankAccountDetails->getBankAccountId());
    }
}
