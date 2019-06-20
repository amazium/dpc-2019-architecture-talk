<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-04-01}
 */

namespace Amazium\SampleApp\Infrastructure\Db\Repository;

use Amazium\Kernel\Infrastructure\Db\Engine\Engine;
use Amazium\SampleApp\Domain\Aggregate\BankAccount as BankAccountModel;
use Amazium\SampleApp\Domain\ValueObject\BankAccountId;
use Amazium\SampleApp\Domain\ValueObject\BankAccountState;
use Amazium\SampleApp\Domain\ValueObject\IdentityId;
use Amazium\SampleApp\Domain\Repository\BankAccount as BankAccountRepository;
use Amazium\SampleApp\Infrastructure\Db\Mapper\BankAccount as BankAccountMapper;

class BankAccount implements BankAccountRepository
{
    /**
     * @var Engine
     */
    private $dbEngine;

    /**
     * BankAccount constructor.
     * @param Engine $dbEngine
     */
    public function __construct(Engine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param BankAccountModel $bankAccount
     * @return bool
     */
    public function save(BankAccountModel $bankAccount): bool
    {
        if ($bankAccount->getInternalId()) {
            return $this->dbEngine->update(
                'bank_account',
                BankAccountMapper::bankAccountModelToTableData($bankAccount),
                [ 'id' => $bankAccount->getInternalId()->scalar() ]
            ) !== false;
        } else {
            return $this->dbEngine->insert(
                'bank_account',
                BankAccountMapper::bankAccountModelToTableData($bankAccount)
            );
        }
    }

    /**
     * @param BankAccountId $bankAccountId
     * @return BankAccountModel|null
     * @throws \Exception
     */
    public function findById(BankAccountId $bankAccountId): ?BankAccountModel
    {
        $results = $this->dbEngine->find('bank_account', [ 'id' => $bankAccountId->scalar() ]);
        if (count($results) === 1) {
            return BankAccountMapper::tableDataToBankAccountModel($results[0]);
        }
        return null;
    }

    /**
     * @param BankAccountId $bankAccountId
     * @return array|null
     * @throws \Exception
     */
    public function fetchById(BankAccountId $bankAccountId): ?array
    {
        $results = $this->dbEngine->find('v_bank_account_detail', [ 'bank_account_id' => $bankAccountId->scalar() ]);
        if (count($results) === 1) {
            return $results[0];
        }
        return null;
    }

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
    ): array {
        $where = [];
        if (!is_null($bankName)) {
            $where['bank_name'] = $bankName;
        }
        if (!is_null($state)) {
            $where['state'] = $state->scalar();
        }
        if (!is_null($identityId)) {
            $where['identity_id'] = $identityId->scalar();
        }
        return $this->dbEngine->find(
            'v_bank_account_overview',
            $where
        );
    }
}
