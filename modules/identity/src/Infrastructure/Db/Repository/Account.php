<?php
/**
 * Amazium Application
 *
 * @copyright Amazium bvba
 * @since {2019-03-30}
 */

namespace Amazium\Identity\Infrastructure\Db\Repository;

use Amazium\Identity\Domain\Aggregate\Account as AccountModel;
use Amazium\Identity\Infrastructure\Db\Mapper\Account as AccountMapper;
use Amazium\Identity\Domain\Entity\AuthenticatedUser;
use Amazium\Kernel\Core\Exception\LogicException;
use Amazium\Kernel\Domain\ValueObject\Number\InternalIdentifier;
use Amazium\Kernel\Domain\ValueObject\Text\EmailAddress;
use Zend\Expressive\Authentication\UserInterface;

class Account extends AbstractAccount
{
    /**
     * @param array $account
     * @return AccountModel|null
     * @throws \Exception
     */
    protected function enrichAccount(array $account): ?AccountModel
    {
        if (empty($account)) {
            return null;
        }

        // Set up data
        $data = [
            'account' => $account
        ];

        // Set up roles
        $roles = $this->dbEngine->find(
            'account_roles',
            [ 'account_id' => $account['id'] ]
        );
        if (!empty($roles)) {
            $data['account_roles'] = $roles;
        }

        // Set up external identifiers
        $externalIdentifiers = $this->dbEngine->find(
            'account_external_identifiers',
            [ 'account_id' => $account['id'] ]
        );
        if (!empty($externalIdentifiers)) {
            $data['account_external_identifiers'] = $externalIdentifiers;
        }

        // Create account model
        return AccountMapper::mapTablesToModels($data);
    }

    /**
     * @param string $source
     * @param mixed $externalIdentifier
     * @return AccountModel|null
     */
    public function findByExternalIdentifier(string $source, $externalIdentifier): ?AccountModel
    {
        // Find external identifiers
        $externalIdentifiers = $this->dbEngine->find(
            'account_external_identifiers',
            [
                'source' => $source,
                'external_identifier' => $externalIdentifier,
            ]
        );
        $found = count($externalIdentifiers);
        if ($found === 1) {
            $accountId = $externalIdentifiers[0]['account_id'];
            $identifier = InternalIdentifier::fromValue($accountId);
            return $this->findByInternalId($identifier);
        } elseif ($found === 0) {
            return null;
        }
        throw new LogicException(sprintf(
            'More than one result found for %s > %s',
            $source,
            $externalIdentifier
        ));
    }

    /**
     * @param string $credential
     * @param string|null $password
     * @return UserInterface|null
     */
    public function authenticateUsingUsernameAndPassword(string $credential, string $password): ?AuthenticatedUser
    {
        $account = $this->findByEmailAddress(EmailAddress::fromValue($credential));
        if ($account->getPassword()->verify($password)) {
            return AuthenticatedUser::fromAccount($account);
        }
        return null;
    }

    /**
     * @param string $source
     * @param $externalIdentifier
     * @return AuthenticatedUser|null
     */
    public function authenticateUsingExternalIdentifier(string $source, $externalIdentifier): ?AuthenticatedUser
    {
        $account = $this->findByExternalIdentifier($source, $externalIdentifier);
        if (!is_null($account)) {
            return AuthenticatedUser::fromAccount($account);
        }
        return null;
    }
}
