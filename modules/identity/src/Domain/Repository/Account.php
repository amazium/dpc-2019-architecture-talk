<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Domain\Repository;

use Amazium\Identity\Domain\Aggregate\Account as AccountModel;
use Amazium\Identity\Domain\ValueObject\AccountId;
use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Kernel\Application\Authentication\AuthenticatedUserRepositoryInterface;
use Amazium\Kernel\Domain\ValueObject\Number\InternalIdentifier;
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Zend\Expressive\Authentication\UserRepositoryInterface;

interface Account extends AuthenticatedUserRepositoryInterface
{
    /**
     * @param AccountModel $account
     * @return bool
     */
    public function save(AccountModel $account): bool;

    /**
     * @param AccountId $accountId
     * @return AccountModel
     */
    public function findById(AccountId $accountId): ?AccountModel;

    /**
     * @param InternalIdentifier $internalIdentifier
     * @return AccountModel
     */
    public function findByInternalId(InternalIdentifier $internalIdentifier): ?AccountModel;

    /**
     * @param EmailAddress $emailAddress
     * @return AccountModel
     */
    public function findByEmailAddress(EmailAddress $emailAddress): ?AccountModel;

    /**
     * @param string $source
     * @param mixed $externalIdentifier
     * @return AccountModel
     */
    public function findByExternalIdentifier(string $source, $externalIdentifier): ?AccountModel;
}
