<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Domain\Repository;

use Amazium\Kernel\Domain\Repository\Repository;
use Amazium\SampleApp\Domain\Aggregate\BankAccount as BankAccountModel;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;
use Amazium\SampleApp\Domain\ValueObject\BankAccountState;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;

interface BankAccount extends Repository
{
    /**
     * @param BankAccountModel $bankAccount
     * @return bool
     */
    public function save(BankAccountModel $bankAccount): bool;

    /**
     * @param BankAccountId $bankAccountId
     * @return BankAccountModel|null
     */
    public function findById(BankAccountId $bankAccountId): ?BankAccountModel;

    /**
     * @param BankAccountId $bankAccountId
     * @return array|null
     */
    public function fetchById(BankAccountId $bankAccountId): ?array;

    /**
     * @param string|null $bankName
     * @param BankAccountState|null $state
     * @param IdentityId|null $identityId
     * @return array
     */
    public function fetchAll(
        ?string $bankName = null,
        ?BankAccountState $state = null,
        ?IdentityId $identityId = null
    ): array;
}
