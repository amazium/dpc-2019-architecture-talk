<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\Kernel\Application\Context\Context;
use Amazium\Kernel\Application\Query\QueryFetcher;

interface BankAccountsForOverviewFetcher extends QueryFetcher
{
    /**
     * @param BankAccountsForOverview $accountsForOverview
     * @param Context $context
     * @return mixed
     */
    public function fetch(BankAccountsForOverview $accountsForOverview, Context $context);
}
