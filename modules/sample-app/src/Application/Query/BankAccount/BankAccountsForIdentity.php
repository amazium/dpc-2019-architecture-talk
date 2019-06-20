<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Application\Query\BankAccount;

use Amazium\SampleApp\Domain\ValueObject\BankAccountState;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

class BankAccountsForIdentity extends BankAccountsForOverview
{
    /**
     * BankAccountsForIdentity constructor.
     * @param IdentityId $identityId
     * @param string|null $bankName
     * @param BankAccountState|null $state
     */
    public function __construct(
        IdentityId $identityId,
        ?string $bankName = null,
        ?BankAccountState $state = null
    ) {
        parent::__construct($bankName, $state, $identityId);
    }
}
