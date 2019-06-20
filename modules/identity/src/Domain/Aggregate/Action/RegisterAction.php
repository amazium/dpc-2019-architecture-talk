<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\Aggregate\Action;

use Amazium\Identity\Domain\Aggregate\Account;
use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Identity\Domain\ValueObject\AccountState;
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Amazium\Kernel\Domain\ValueObject\Text\Password;

class Register
{
    /**
     * @param AccountId $accountId
     * @param string $name
     * @param EmailAddress $emailAddress
     * @param Password|null $password
     * @return Account
     * @throws \Exception
     */
    public function __invoke(
        AccountId $accountId,
        string $name,
        EmailAddress $emailAddress,
        ?Password $password = null
    ): Account {
        /** @anchor(Amazium\Identity\Domain\Aggregate\Action\Register, start) */
        return new Account(
            $accountId,
            $name,
            $name,
            $emailAddress,
            $password ?: Password::generate(),
            AccountState::fromValue(AccountState::REGISTERED)
        );
        /** @anchor(Amazium\Identity\Domain\Aggregate\Action\Register, end) */
    }
}
