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

interface BankAccountsForIdentityFetcher extends QueryFetcher
{
    /**
     * @param BankAccountsForIdentity $bankAccountsForIdentity
     * @param Context $context
     * @return mixed
     */
    public function fetch(BankAccountsForIdentity $bankAccountsForIdentity, Context $context);
}
