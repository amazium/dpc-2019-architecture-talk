<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Infrastructure\Db\Repository;

use Amazium\Identity\Domain\Aggregate\Account as AccountModel;
use Amazium\Identity\Domain\Repository\Account as AccountRepository;
use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Identity\Infrastructure\Db\Mapper\Account as AccountMapper;

use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\Domain\ValueObject\Number\InternalIdentifier;
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Amazium\Kernel\Infrastructure\Db\Engine\Engine as DbEngine;

abstract class AbstractAccount implements AccountRepository
{
    /**
     * @var DbEngine
     */
    protected $dbEngine;

    /**
     * Account constructor.
     * @param DbEngine $dbEngine
     */
    public function __construct(DbEngine $dbEngine)
    {
        $this->dbEngine = $dbEngine;
    }

    /**
     * @param array $account
     * @return AccountModel|null
     */
    abstract protected function enrichAccount(array $account): ?AccountModel;

    /**
     * @param string $source
     * @param mixed $externalIdentifier
     * @return AccountModel|null
     */
    abstract public function findByExternalIdentifier(string $source, $externalIdentifier): ?AccountModel;

    /**
     * @param AccountModel $account
     * @return bool
     */
    public function save(AccountModel $account): bool
    {
        $tables = AccountMapper::mapModelToTables($account);
        $accountData = $tables['account'];
        unset($tables['account']);

        // Save account
        if ($account->getInternalId()) {
            $this->dbEngine->update(
                'account',
                $accountData,
                [ 'id' => $account->getInternalId() ]
            );
            $this->dbEngine->delete(
                'account_roles',
                [ 'account_id' => $account->getInternalId() ]
            );
            $this->dbEngine->delete(
                'account_external_identifiers',
                [ 'account_id' => $account->getInternalId() ]
            );
        } else {
            $accountData['id'] = $this->dbEngine->insert(
                'account',
                $accountData
            );
        }

        // Other tables
        foreach ($tables as $tableName => $records) {
            foreach ($records as $record) {
                $this->dbEngine->insert($tableName, $record);
            }
        }

        return true;
    }

    /**
     * @param AccountId $accountId
     * @return AccountModel|null
     */
    public function findById(AccountId $accountId): ?AccountModel
    {
        $where = [
            'uuid' => $accountId->scalar(),
        ];
        $account = $this->findAccountsByWhere($where, true);
        return $this->enrichAccount($account);
    }

    /**
     * @param InternalIdentifier $internalIdentifier
     * @return AccountModel|null
     */
    public function findByInternalId(InternalIdentifier $internalIdentifier): ?AccountModel
    {
        $where = [
            'id' => $internalIdentifier->scalar(),
        ];
        $account = $this->findAccountsByWhere($where, true);
        return $this->enrichAccount($account);
    }

    /**
     * @param EmailAddress $emailAddress
     * @return AccountModel|null
     */
    public function findByEmailAddress(EmailAddress $emailAddress): ?AccountModel
    {
        $where = [
            'email_address' => $emailAddress->scalar(),
        ];
        $account = $this->findAccountsByWhere($where, true);
        return $this->enrichAccount($account);
    }

    /**
     * @param array $where
     * @param bool $expectsOne
     * @return array
     */
    protected function findAccountsByWhere(array $where, bool $expectsOne = false): array
    {
        $results = $this->dbEngine->find('account', $where);
        if ($expectsOne) {
            $found = count($results);
            if ($found === 1) {
                return $results[0];
            } elseif ($found === 0) {
                return [];
            } else {
                throw new LogicException(sprintf(
                    'More than one result found for where: %s',
                    print_r($where, true)
                ));
            }
        }
        return $results;
    }
}
